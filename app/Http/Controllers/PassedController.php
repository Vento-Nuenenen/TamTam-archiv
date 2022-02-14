<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PassedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $participations = DB::table('participations')->select('participations.*')->get();

        return view('passed.passed', ['participations' => $participations]);
    }

    public function set_flag(Request $request)
    {
        ! empty($request->input('has_passed')) ? $passed = $request->input('has_passed') : $passed = [];
        ! empty($request->input('not_passed')) ? $not_passed = array_diff($request->input('not_passed'), $passed) : $not_passed = [];

        foreach ($passed as $pass) {
            DB::table('participations')->where('id', '=', $pass)->update(['course_passed' => true]);
        }

        foreach ($not_passed as $npsd) {
            DB::table('participations')->where('id', '=', $npsd)->update(['course_passed' => false]);
        }

        return redirect()->back()->with('message', 'Besanden wurde aktualisiert');
    }
}
