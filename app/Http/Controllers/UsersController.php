<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->input('search') == null) {
            $users = DB::table('users')->select('users.*')->get();
        } else {
            $search_string = $request->input('search');
            $users = DB::table('users')
                ->select('users.*')
                ->where('scout_name', 'LIKE', "%$search_string%")
                ->orWhere('last_name', 'LIKE', "%$search_string%")
                ->orWhere('first_name', 'LIKE', "%$search_string%")->get();
        }

        return view('users.users', ['users' => $users]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add');
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

        $password = $request->input('password');
        $password_repeat = $request->input('password_repeat');

        if ($password != null && $password === $password_repeat) {
            $password = Hash::make($password);

            $password_repeat = null;

            DB::table('users')->insert(['scout_name' => $scout_name, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password]);

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

        return view('users.edit', ['users' => $users]);
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

        $password = $request->input('password');
        $password_repeat = $request->input('password_repeat');

        if ($password != null && $password === $password_repeat) {
            $password = Hash::make($password);

            $password_repeat = null;

            DB::table('users')->where('id', '=', $uid)->update(['scout_name' => $scout_name, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password]);

            return redirect()->back()->with('message', 'Benutzer wurde aktualisiert.');
        } elseif ($password == null) {
            DB::table('users')->where('id', '=', $uid)->update(['scout_name' => $scout_name, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);

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
