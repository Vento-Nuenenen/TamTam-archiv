<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Participant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $participations = Participant::all();
        $items = Item::all();

        return view('sales.sales', ['participations' => $participations, 'items' => $items]);
    }
}
