<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class OverwatchController extends Controller
{
    public function index(Request $request){
        if ($request->input('barcode') == null){
            return view('overwatch.overwatch');
        }else{
            $barcode = $request->input('barcode');
            $user = DB::table('participations')->select('participations.*')->where('barcode', '=', $barcode)->first();

            return view('overwatch.overwatch', ['user' => $user]);
        }
    }

    public function getTN(){
        return view();
    }
}
