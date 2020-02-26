<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EmergencyController extends Controller
{
    public function index(){
	    $numbers = DB::table('emergency_numbers')->select('emergency_numbers.*')->get();

	    return view('numbers.numbers', ['numbers' => $numbers]);
    }

	public function create(){
		$numbers = DB::table('emergency_numbers')->select('emergency_numbers.*')->get();

		return view('numbers.add', ['numbers' => $numbers]);
	}

	public function store(){
		$numbers = DB::table('emergency_numbers')->select('emergency_numbers.*')->get();

		return redirect()->back()->with('message', 'Nummer wurde erstellt.');
	}

	public function edit(){
		$numbers = DB::table('emergency_numbers')->select('emergency_numbers.*')->get();

		return view('numbers.edit', ['numbers' => $numbers]);
	}

	public function update(){
		$numbers = DB::table('emergency_numbers')->select('emergency_numbers.*')->get();

		return redirect()->back()->with('message', 'Nummer wurde aktualisiert.');
	}

	public function destroy($nid){
		DB::table('emergency_number')->where('id', '=', $nid)->delete();

		return redirect()->back()->with('message', 'Nummer erfolgreich gelöscht.');
    }
}
