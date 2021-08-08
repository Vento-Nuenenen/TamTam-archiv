<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Participant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $participations = Participant::all();
        $items = Item::all();

        return view('sales.sales', ['participations' => $participations, 'items' => $items]);
    }

    /**
     * Lookup EAN Codes.
     *
     * @param Request $request
     *
     * @return Application|Response|ResponseFactory
     */
    public function lookup(Request $request)
    {
        $item = Item::where('item_barcode', '=', $request->ean)->get();

        return response($item, 200);
    }

    public function store(Request $request)
    {
        print_r($request->input());
    }
}
