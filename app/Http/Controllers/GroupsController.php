<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->search == null) {
            $groups = Group::all();
        } else {
            $search_string = $request->search;
            $groups = Group::where('groups.name', 'LIKE', "%$search_string%")->get();
        }

        return view('groups.groups', ['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('groups.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $group_name = $request->input('group_name');

        if ($request->file('image')) {
            $logo_name = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(storage_path('app/public/img'), $logo_name);
        } else {
            $logo_name = null;
        }

        DB::table('groups')->insert(['name' => $group_name, 'image' => $logo_name]);

        return redirect()->back()->with('message', 'Gruppe wurde erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $gid
     * @return Application|Factory|View
     */
    public function edit($gid)
    {
        $groups = DB::table('groups')->where('id', '=', $gid)->first();

        return view('groups.edit', ['groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param $gid
     * @return RedirectResponse
     */
    public function update(Request $request, $gid)
    {
        $group_name = $request->input('group_name');

        if ($request->file('image')) {
            $logo_name = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(storage_path('app/public/img'), $logo_name);
        } else {
            $logo_name = null;
        }

        $group = Group::find($gid);
        $group->group_name = $group_name;

        if ($logo_name != null) {
            $group->logo_file_name = $logo_name;
        }

        $group->save();

        return redirect()->back()->with('message', 'Gruppe wurde aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $gid
     * @return RedirectResponse
     */
    public function destroy($gid)
    {
        DB::table('groups')->where('id', '=', $gid)->delete();

        return redirect()->back()->with('message', 'Gruppe erfolgreich gelöscht.');
    }
}
