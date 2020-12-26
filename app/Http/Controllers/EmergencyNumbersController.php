<?php

namespace App\Http\Controllers;

use App\Models\EmergencyNumbers;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmergencyNumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $numbers = EmergencyNumbers::orderBy('order', 'ASC')->get();

        return view('numbers.numbers', ['numbers' => $numbers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('numbers.add');
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
        $number_name = $request->input('number_name');
        $number = $request->input('number');

        DB::table('emergency_numbers')->insert([
            'name' => $number_name,
            'number' => $number
        ]);

        return redirect()->back()->with('message', 'Nummer wurde erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $nid
     *
     * @return Application|Factory|View|Response
     */
    public function edit($nid)
    {
        $number = DB::table('emergency_numbers')->where('id', '=', $nid)->first();

        return view('numbers.edit', ['number' => $number]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $nid
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $nid)
    {
        $number_name = $request->input('number_name');
        $number = $request->input('number');

        DB::table('emergency_numbers')->where('id', '=', $nid)->update(['name' => $number_name, 'number' => $number]);

        return redirect()->back()->with('message', 'Nummer wurde aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $nid
     *
     * @return RedirectResponse
     */
    public function destroy($nid)
    {
        DB::table('emergency_numbers')->where('id', '=', $nid)->delete();

        return redirect()->back()->with('message', 'Nummer erfolgreich gelöscht.');
    }

    public function sort(Request $request)
    {
        $numbers = EmergencyNumbers::all();

        foreach ($numbers as $number) {
            foreach ($request->order as $order) {
                if (array_key_exists('id', $order) && $order['id'] == $number->id) {
                    $number->update(['order' => $order['position']]);
                }
            }
        }

        return response('Update Successfully.', 200);
    }
}
