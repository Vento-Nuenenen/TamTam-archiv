<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Group;
use App\Models\Item;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->search == null) {
            $items = Item::all();
        } else {
            $search_string = $request->search;
            $items = DB::table('items')
                ->select('items.*')
                ->where('items.item_name', 'LIKE', "%$search_string%")
                ->orWhere('items.item_barcode', 'LIKE', "%$search_string%")->get();
        }

        return view('items.items', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('items.add');
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
        $item_name = $request->item_name;
        $item_price = $request->item_price;

        $item_barcode = Helper::generateBarcode();

        Item::create([
            'item_name' => $item_name,
            'item_price' => $item_price,
            'item_barcode' => $item_barcode,
        ]);

        return redirect()->back()->with('message', 'Artikel wurde erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $iid
     *
     * @return Application|Factory|View|Response
     */
    public function edit($iid)
    {
        $item = Item::where('id', '=', $iid)->first();

        return view('items.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $iid
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $iid)
    {
        $item_name = $request->item_name;
        $item_price = $request->item_price;
        $item_barcode = $request->item_barcode;

        $item = Item::find($iid);
        $item->item_name = $item_name;
        $item->item_price = $item_price;

        if ($item_barcode != null) {
            $item->item_barcode = $item_barcode;
        }

        $item->save();

        return redirect()->back()->with('message', 'Artikel wurde aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $gid
     *
     * @return RedirectResponse
     */
    public function destroy($gid)
    {
        Item::destroy($gid);

        return redirect()->back()->with('message', 'Artikel erfolgreich gelöscht.');
    }
}
