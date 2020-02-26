<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointsController extends Controller
{
	public function index(Request $request)
	{
		
		return view('users.users', ['users' => $users]);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$groups = DB::table('group')->select('id', 'group_name')->get();
		return view('users.add', ['groups' => $groups]);
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$scout_name = $request->input('scout_name');
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$email = $request->input('email');
		$group = $request->input('group');
		$password = $request->input('password');
		$password_repeat = $request->input('password_repeat');
		if ($password != null && $password === $password_repeat) {
			$password = Hash::make($password);
			$password_repeat = null;
			DB::table('users')->insert(['scout_name' => $scout_name, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password, 'FK_GRP' => $group]);
			return redirect()->back()->with('message', 'Benutzer wurde erstellt.');
		} else {
			return redirect()->back()->with('error', 'Passwort wurde nicht korrekt wiederholt!');
		}
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $uid
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($uid)
	{
		$users = DB::table('users')->where('id', '=', $uid)->first();
		$groups = DB::table('group')->select('group.id', 'group.group_name')->get();
		return view('users.edit', ['users' => $users, 'groups' => $groups]);
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param                          $uid
	 *
	 * @return void
	 */
	public function update(Request $request, $uid)
	{
		$scout_name = $request->input('scout_name');
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$email = $request->input('email');
		$group = $request->input('group');
		$password = $request->input('password');
		$password_repeat = $request->input('password_repeat');
		if ($password != null && $password === $password_repeat) {
			$password = Hash::make($password);
			$password_repeat = null;
			DB::table('users')->where('id', '=', $uid)->update(['scout_name' => $scout_name, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password, 'FK_GRP' => $group]);
			return redirect()->back()->with('message', 'Benutzer wurde aktualisiert.');
		} elseif ($password == null) {
			DB::table('users')->where('id', '=', $uid)->update(['scout_name' => $scout_name, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'FK_GRP' => $group]);
			return redirect()->back()->with('message', 'Benutzer wurde aktualisiert. Das Passwort wurde beibehalten!');
		} else {
			return redirect()->back()->with('error', 'Passwort wurde nicht korrekt wiederholt!');
		}
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $uid
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($uid)
	{
		DB::table('users')->where('id', '=', $uid)->delete();
		return redirect()->back()->with('message', 'Benutzer erfolgreich gelöscht.');
	}
}
