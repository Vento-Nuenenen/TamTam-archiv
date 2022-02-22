<?php

namespace App\Http\Controllers;

use App\Models\EmergencyNumber;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EmergencyNumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $numbers = EmergencyNumber::orderBy('order', 'ASC')->get();

        return view('numbers.numbers', ['numbers' => $numbers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
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
    public function store(Request $request): RedirectResponse
    {
        $number_name = $request->input('number_name');
        $number = $request->input('number');

        DB::table('emergency_numbers')->insert([
            'name' => $number_name,
            'number' => $number,
        ]);

        return redirect()->back()->with('message', 'Nummer wurde erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $nid
     *
     * @return Application|Factory|View
     */
    public function edit(int $nid)
    {
        $number = DB::table('emergency_numbers')->where('id', '=', $nid)->first();

        return view('numbers.edit', ['number' => $number]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $nid
     *
     * @return RedirectResponse
     */
    public function update(Request $request, int $nid): RedirectResponse
    {
        $number_name = $request->input('number_name');
        $number = $request->input('number');

        DB::table('emergency_numbers')->where('id', '=', $nid)
            ->update(['name' => $number_name, 'number' => $number]);

        return redirect()->back()->with('message', 'Nummer wurde aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $nid
     *
     * @return RedirectResponse
     */
    public function destroy(int $nid): RedirectResponse
    {
        DB::table('emergency_numbers')->where('id', '=', $nid)->delete();

        return redirect()->back()->with('message', 'Nummer erfolgreich gelöscht.');
    }

    /**
     * Change sorting of entries.
     *
     * @param Request $request
     *
     * @return Application|ResponseFactory|Response
     */
    public function sort(Request $request)
    {
        $numbers = EmergencyNumber::all();

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
