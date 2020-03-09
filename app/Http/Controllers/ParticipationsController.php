<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Carbon\Carbon;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ParticipationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->input('search') == null) {
            $participations = DB::table('participations')
                ->leftJoin('groups', 'groups.id', '=', 'participations.FK_GRP')
                ->select('participations.*', 'groups.group_name')->get();
        } else {
            $search_string = $request->input('search');
            $participations = DB::table('participations')
                ->leftJoin('groups', 'groups.id', '=', 'participations.FK_GRP')
                ->select('participations.*', 'groups.group_name')
                ->where('scout_name', 'LIKE', "%$search_string%")
                ->orWhere('last_name', 'LIKE', "%$search_string%")
                ->orWhere('first_name', 'LIKE', "%$search_string%")
                ->orWhere('group_name', 'LIKE', "%$search_string%")
	            ->orWhere('barcode', 'LIKE', "%$search_string%")->get();
        }

        return view('participations.participations', ['participations' => $participations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $groups = DB::table('groups')->select('id', 'group_name')->get();

        return view('participations.add', ['groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $scout_name = $request->input('scout_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $plz = $request->input('plz');
        $place = $request->input('place');
        $birthday = $request->input('birthday');
        $gender = $request->input('gender');
        $group = $request->input('group');
        $barcode  = Helper::generateBarcode();

	    if($request->file('tn_img')){
		    $img_name = 'tnimg_' . time() .'.' . $request->file('tn_img')->extension();
		    $request->file('tn_img')->move(storage_path('app/public/img'), $img_name);
	    }else{
		    $img_name = null;
	    }

        if($gender){
        	if($gender == 'm'){
				$gender = 'Männlich';
	        }elseif($gender == 'w'){
		        $gender = 'Weiblich';
	        }elseif($gender == 'd'){
		        $gender = 'Anderes';
	        }else{
        		$gender = null;
	        }
        }else{
	        $gender = null;
        }

        DB::table('participations')->insert([
        	'scout_name' => $scout_name,
	        'first_name' => $first_name,
	        'last_name' => $last_name,
	        'barcode' => $barcode,
	        'address' => $address,
	        'plz' => $plz,
	        'place' => $place,
	        'birthday' => $birthday,
	        'gender' => $gender,
	        'FK_GRP' => $group,
	        'person_picture' => $img_name,
        ]);

        return redirect()->back()->with('message', 'Teilnehmer wurde erstellt.');
    }

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function import(Request $request)
    {
        if ($request->file('participations_list')) {
            $participations_list = $request->file('participations_list')->move(storage_path('temp/csv'), 'participations.csv');
        } else {
            return redirect()->back()->with('error', 'Die Teilnehmer konnten nicht importiert werden, da keine entsprehende Datei gesendet wurde.');
        }

        $contents = read_file($participations_list);

        foreach ($contents as $content) {
	        if($content[0] == 'Vorname' || $content[0] == 'Nachname' || $content[0] == 'Pfadiname'){
				unset($content);
	        }else{
	        	if(isset($content[6])){
	        		if($content[6][0] == 'm'){
	        			$gnd = 'Männlich';
			        }elseif($content[6][0] == 'w'){
				        $gnd = 'Weiblich';
			        }elseif($content[6][0] == 'u'){
				        $gnd = 'Anderes';
			        }else{
	        			$gnd = null;
			        }
		        }else{
	        		$gnd = null;
		        }

		        $carbon_birthday = Carbon::createFromFormat('d.m.Y', $content[7]);
		        $birthday = $carbon_birthday->format('Y-m-d');
	        	$barcode = Helper::generateBarcode();

		        isset($content[8]) ? $grp = DB::table('groups')->select('id')->where('group_name', 'LIKE', "%$content[8]%")->first() : $grp = null;
		        DB::table('participations')->insert(['first_name' => $content[0], 'last_name' => $content[1], 'scout_name' => $content[2], 'address' => $content[3], 'plz' => $content[4], 'place' => $content[5], 'gender' => $gnd, 'birthday' => $birthday, 'FK_GRP' => $grp, 'barcode' => $barcode]);
	        }
        }

        return redirect()->back()->with('message', 'Die TN wurden importiert!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $pid
     *
     * @return Factory|View
     */
    public function edit($pid)
    {
        $participations = DB::table('participations')->where('id', '=', $pid)->first();
        $groups = DB::table('groups')->select('groups.id', 'groups.group_name')->get();

        return view('participations.edit', ['participations' => $participations, 'groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param                          $pid
     *
     * @return Response
     */
    public function update(Request $request, $pid)
    {
        $scout_name = $request->input('scout_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
	    $address = $request->input('address');
	    $plz = $request->input('plz');
	    $place = $request->input('place');
	    $birthday = $request->input('birthday');
	    $gender = $request->input('gender');
	    $group = $request->input('group');
	    $barcode  = $request->input('barcode');

	    if($gender){
		    if($gender == 'm'){
			    $gender = 'Männlich';
		    }elseif($gender == 'w'){
			    $gender = 'Weiblich';
		    }elseif($gender == 'd'){
			    $gender = 'Anderes';
		    }else{
			    $gender = null;
		    }
	    }else{
		    $gender = null;
	    }

	    if($request->file('tn_img')){
		    $img_name = 'tnimg_' . time() .'.' . $request->file('tn_img')->extension();
		    $request->file('tn_img')->move(storage_path('app/public/img'), $img_name);
	    }else{
	    	$img_name = null;
	    }

        DB::table('participations')->where('id', '=', $pid)->update([
        	'scout_name' => $scout_name,
	        'first_name' => $first_name,
	        'last_name' => $last_name,
	        'barcode' => $barcode,
	        'address' => $address,
	        'plz' => $plz,
	        'place' => $place,
	        'birthday' => $birthday,
	        'gender' => $gender,
	        'FK_GRP' => $group,
	        'person_picture' => $img_name,
        ]);

        return redirect()->back()->with('message', 'Teilnehmer wurde aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $uid
     *
     * @return Response
     */
    public function destroy($uid)
    {
        DB::table('participations')->where('id', '=', $uid)->delete();
        return redirect()->back()->with('message', 'Teilnehmer erfolgreich gelöscht.');
    }
}
