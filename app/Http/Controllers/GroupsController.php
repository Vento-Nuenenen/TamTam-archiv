<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('search') == null) {
            $groups = DB::table('group')
                ->leftJoin('field', 'field.id', '=', 'group.FK_FLD')
                ->select('group.id as group_id', 'group.group_name', 'field.field_name')->get();
        } else {
            $search_string = $request->input('search');
            $groups = DB::table('group')
                ->leftJoin('field', 'field.id', '=', 'group.FK_FLD')
                ->select('group.id as group_id', 'group.group_name', 'field.field_name')
                ->where('group.group_name', 'LIKE', "%$search_string%")
                ->orWhere('field.field_name', 'LIKE', "%$search_string%")
                ->orWhere('field.field_description', 'LIKE', "%$search_string%")->get();
        }
        return view('groups.groups', ['groups' => $groups]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = DB::table('field')->get();
        return view('groups.add', ['fields' => $fields]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $group_name = $request->input('group_name');
        $field = $request->input('field');
        DB::table('group')->insert(['group_name' => $group_name, 'FK_FLD' => $field]);
        return redirect()->back()->with('message', 'Gruppe wurde erstellt.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param $gid
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($gid)
    {
        $groups = DB::table('group')->where('id', '=', $gid)->first();
        $fields = DB::table('field')->get();
        return view('groups.edit', ['groups' => $groups, 'fields' => $fields]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $gid
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gid)
    {
        $group_name = $request->input('group_name');
        $field = $request->input('field');
        DB::table('group')->where('id', '=', $gid)->update(['group_name' => $group_name, 'FK_FLD' => $field]);
        return redirect()->back()->with('message', 'Gruppe wurde aktualisiert.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $gid
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($gid)
    {
        DB::table('group')->where('id', '=', $gid)->delete();
        return redirect()->back()->with('message', 'Gruppe erfolgreich gelöscht.');
    }
}
