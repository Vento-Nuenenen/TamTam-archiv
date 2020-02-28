<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\User;
use DB;
use DNS1D;
use File;
use Illuminate\Http\Request;
use RuntimeException;
use Storage;

class ParticipationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
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
                ->leftJoin('group', 'group.id', '=', 'participations.FK_GRP')
                ->select('participations.*', 'group.group_name')
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = DB::table('group')->select('id', 'group_name')->get();

        return view('participations.add', ['groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scout_name = $request->input('scout_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $group = $request->input('group');
        $barcode  = Helper::generateBarcode();

        DB::table('participations')->insert(['scout_name' => $scout_name, 'first_name' => $first_name, 'last_name' => $last_name, 'barcode' => $barcode, 'FK_GRP' => $group]);

        return redirect()->back()->with('message', 'Teilnehmer wurde erstellt.');
    }

    public function import(Request $request)
    {
        if ($request->file('participations_list')) {
            $participations_list = $request->file('participations_list')->move(storage_path('temp/csv'), 'participations.csv');
        } else {
            return redirect()->back()->with('error', 'Die Teilnehmer konnten nicht importiert werden, da keine entsprehende Datei gesendet wurde.');
        }

        $handle = fopen($participations_list, 'r');
        $content = mb_convert_encoding(fread($handle, filesize($participations_list)), 'UTF-8', 'Windows-1252');
        $lines = preg_split("/(\n)/", $content);
        $number_participations = count($lines);
        unset($lines[$number_participations - 1]);
        foreach ($lines as $line) {
            $contents[] = explode(';', $line);
        }
        fclose($handle);

        foreach ($contents as $content) {
            $grp = DB::table('group')->select('id')->where('name', 'LIKE', "%$content[3]%")->first();
            $content[4] = str_replace("\r", '', $content[4]);
            DB::table('participations')->insert(['scout_name' => $content[0], 'first_name' => $content[1], 'last_name' => $content[2], 'FK_GRP' => $grp->id]);
        }

        return redirect()->back()->with('message', 'Die TN wurden importiert!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $pid
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($pid)
    {
        $participations = DB::table('participations')->where('id', '=', $pid)->first();
        $groups = DB::table('group')->select('group.id', 'group.group_name')->get();

        return view('participations.edit', ['participations' => $participations, 'groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $pid
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pid)
    {
        $scout_name = $request->input('scout_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $group = $request->input('group');
        $barcode = $request->input('barcode');

        DB::table('participations')->where('id', '=', $pid)->update(['scout_name' => $scout_name, 'first_name' => $first_name, 'last_name' => $last_name, 'barcode' => $barcode, 'FK_GRP' => $group]);

        return redirect()->back()->with('message', 'Teilnehmer wurde aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $uid
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        DB::table('participations')->where('id', '=', $uid)->delete();
        return redirect()->back()->with('message', 'Teilnehmer erfolgreich gelöscht.');
    }
}
