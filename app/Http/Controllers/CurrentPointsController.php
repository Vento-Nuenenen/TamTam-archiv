<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrentPointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if($request->input('search') == null) {
            $participations = DB::select('SELECT participations.*, points.*, GROUP_CONCAT(points.points) AS points,
				GROUP_CONCAT(points.is_addition) AS additions FROM `participations`
  			    LEFT JOIN `points` ON `points`.`FK_PRT` = `participations`.`id` GROUP BY participations.id;');
        } else {
            $search_string = $request->input('search');
            $participations = DB::select("SELECT participations.*, points.*, GROUP_CONCAT(points.points) AS points,
				GROUP_CONCAT(points.is_addition) AS additions FROM `participations`
  			    LEFT JOIN `points` ON `points`.`FK_PRT` = `participations`.`id`
  			     WHERE scout_name LIKE '%$search_string%'
  			     OR last_name LIKE '%$search_string%'
  			     OR first_name LIKE '%$search_string%'
  			     OR barcode LIKE '%$search_string%'
  			      GROUP BY participations.id;");
        }

        foreach($participations as $participant) {
            $balance = 0;

            if(!empty($participant->points) || !empty($participant->additions)) {
                $points = explode(',', $participant->points);
                $additions = explode(',', $participant->additions);

                for($i = 0; $i < count($points); $i++) {
                    if($additions[$i] == 1) {
                        $balance += $points[$i];
                    } else {
                        $balance -= $points[$i];
                    }
                }
            }

            $participant->current_balance = $balance;
        }

        return view('points.points', ['participations' => $participations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $participations = DB::table('participations')->select('*')->get();

        return view('points.add', ['participations' => $participations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $participant = $request->input('participant');
        $points = $request->input('points');
        $reason = $request->input('reason');
        $is_addition = ! empty($request->input('is_addition')) ? true : false;

        DB::table('points')->insert(['reason' => $reason, 'points' => $points, 'is_addition' => $is_addition, 'FK_PRT' => $participant]);

        return redirect()->back()->with('message', 'Transaktion wurde erstellt.');
    }
}
