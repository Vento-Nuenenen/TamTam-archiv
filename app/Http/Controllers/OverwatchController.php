<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class OverwatchController extends Controller
{
    public function index(Request $request){
        if($request->input('barcode') != null){
            $barcode = $request->input('barcode');
            $user = DB::table('participations')->select('participations.*')->where('barcode', '=', $barcode)->first();

            return view('overwatch.overwatch', ['user' => $user]);
       }else if($request->input('tableorder')  != null){
            $users = DB::table('participations')->inRandomOrder()->get();
            $j = 1;

	        foreach($users as $user){
	        	DB::table('participations')->where('id','=', $user->id)->update(['seat_number' => $j]);
	        	$j++;
	        }

           return view('overwatch.overwatch')->with('message', 'Tischordnung wurde erfolgreich generiert!');
       }else if($request->input('grouping')  != null){
        	$groups = DB::table('group')->get();
        	$groups_count = count($groups);
	        $users = DB::table('participations')->inRandomOrder()->get();
	        $j = 1;

	        foreach($users as $user){
	        	if($j <= $groups_count){
	        		DB::table('participations')->where('id','=', $user->id)->update(['FK_GRP' => $j]);
	        		$j++;
		        }else{
	        		$j = 1;
			        DB::table('participations')->where('id','=', $user->id)->update(['FK_GRP' => $j]);
			        $j++;
		        }
	        }

           return view('overwatch.overwatch')->with('message', 'Gruppen wurden erfolgreich zugeordnet!');
       }else{
           return view('overwatch.overwatch');
       }
    }
}
