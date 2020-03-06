<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class OverwatchController extends Controller
{
    public function index(Request $request){
        if($request->input('barcode') != null){
            $barcode = $request->input('barcode');
	        $tns = DB::select("SELECT participations.*, points.*, groups.*, GROUP_CONCAT(points.points) AS points, 
				GROUP_CONCAT(points.is_addition) AS additions FROM `participations`
  			    LEFT JOIN `points` ON `points`.`FK_PRT` = `participations`.`id`
  			    LEFT JOIN `groups` ON `participations`.`FK_GRP` = `groups`.`id` WHERE `participations`.`barcode` LIKE $barcode
 				GROUP BY participations.id;");

	        foreach($tns as $tn){
		        $balance = 0;

		        if(!empty($tn->points) || !empty($tn->additions)){
			        $points = explode(',', $tn->points);
			        $additions = explode(',', $tn->additions);

			        for($i = 0; $i < count($points); $i++){
				        if($additions[$i] == 1){
					        $balance += $points[$i];
				        }else{
					        $balance -= $points[$i];
				        }
			        }
		        }

		        $tn->current_balance = $balance;
	        }

            return view('overwatch.overwatch', ['tn' => $tns[0]]);
       }else if($request->input('tableorder')  != null){
            $users = DB::table('participations')->inRandomOrder()->get();

            $j = 0;

	        foreach($users as $user){
		        $j++;
	        	DB::table('participations')->where('id','=', $user->id)->update(['seat_number' => $j]);
	        }

           return view('overwatch.overwatch')->with('message', 'Tischordnung wurde erfolgreich generiert!');
       }else if($request->input('grouping')  != null){
        	$groups = DB::table('groups')->get();
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
