<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EmergencyNumbersController extends Controller
{
    public function index()
    {
        $numbers = DB::table('emergency_numbers')->select('emergency_numbers.*')->get();

        return view('numbers.numbers', ['numbers' => $numbers]);
    }

    public function create()
    {
        $numbers = DB::table('emergency_numbers')->select('emergency_numbers.*')->get();

        return view('numbers.add', ['numbers' => $numbers]);
    }

    public function store(Request $request)
    {
        $number_name = $request->input('number_name');
        $number = $request->input('number');

        DB::table('emergency_numbers')->insert(['name' => $number_name, 'number' => $number]);

        return redirect()->back()->with('message', 'Nummer wurde erstellt.');
    }

    public function edit($nid)
    {
        $number = DB::table('emergency_numbers')->where('id', '=', $nid)->first();

        return view('numbers.edit', ['number' => $number]);
    }

    public function update(Request $request, $nid)
    {
        $number_name = $request->input('number_name');
        $number = $request->input('number');

        DB::table('emergency_numbers')->where('id', '=', $nid)->update(['name' => $number_name, 'number' => $number]);

        return redirect()->back()->with('message', 'Nummer wurde aktualisiert.');
    }

    public function destroy($nid)
    {
        DB::table('emergency_numbers')->where('id', '=', $nid)->delete();

        return redirect()->back()->with('message', 'Nummer erfolgreich gelöscht.');
    }
}
