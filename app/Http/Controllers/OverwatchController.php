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
            $users = DB::table('participations')->select('*')->get();

            foreach($users as $user){

            }

           return view('overwatch.overwatch')->with('message', 'Tischordnung wurde erfolgreich generiert!');
       }else if($request->input('grouping')  != null){
           return view('overwatch.overwatch')->with('message', 'Gruppen wurden erfolgreich zugeordnet!');
       }else{
           return view('overwatch.overwatch');
       }
    }
}
