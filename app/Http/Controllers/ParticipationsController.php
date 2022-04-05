<?php

namespace App\Http\Controllers;

use App\Helpers\Barcode;
use App\Helpers\CSV;
use App\Models\Group;
use App\Models\Participant;
use Carbon\Carbon;
use Doctrine\Foo\Bar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->input('search') == null) {
            $participations = Participant::with(['group'])->get();
        } else {
            $search_string = $request->input('search');
            $participations = DB::table('participations')
                ->leftJoin('groups', 'groups.id', '=', 'participations.FK_GRP')
                ->select('participations.*', 'groups.group_name')
                ->where('scout_name', 'LIKE', "%$search_string%")
                ->orWhere('last_name', 'LIKE', "%$search_string%")
                ->orWhere('first_name', 'LIKE', "%$search_string%")
                ->orWhere('group_name', 'LIKE', "%$search_string%")
                ->orWhere('barcode', 'LIKE', "%$search_string%")->get();
        }

        return view('participations.participations', ['participations' => $participations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $groups = Group::all();

        return view('participations.add', ['groups' => $groups]);
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
        $scout_name = $request->input('scout_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $plz = $request->input('plz');
        $place = $request->input('place');
        $birthday = $request->input('birthday');
        $gender = $request->input('gender');
        $group = $request->input('group');
        $barcode = Barcode::generateBarcode();

        if ($request->file('tn_img')) {
            $img_name = 'tnimg_'.time().'.'.$request->file('tn_img')->extension();
            $request->file('tn_img')->move(storage_path('app/public/img'), $img_name);
        } else {
            $img_name = null;
        }

        if ($gender) {
            if ($gender == 'm') {
                $gender = 'Männlich';
            } elseif ($gender == 'w') {
                $gender = 'Weiblich';
            } elseif ($gender == 'd') {
                $gender = 'Anderes';
            } else {
                $gender = null;
            }
        } else {
            $gender = null;
        }

        DB::table('participations')->insert([
            'scout_name' => $scout_name,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'barcode' => $barcode,
            'address' => $address,
            'plz' => $plz,
            'place' => $place,
            'birthday' => $birthday,
            'gender' => $gender,
            'FK_GRP' => $group,
            'person_picture' => $img_name,
        ]);

        return redirect()->back()->with('message', 'Teilnehmer wurde erstellt.');
    }

    /**
     * Import participants from csv
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request)
    {
        if ($request->file('participations_list')) {
            $participations_list = $request->file('participations_list')
                ->move(storage_path('temp/csv'), 'participations.csv');
        } else {
            return redirect()->back()
                ->with('error', 'Die Teilnehmer konnten nicht importiert werden, da keine entsprehende Datei gesendet wurde.');
        }

        $contents = CSV::read_csv_file($participations_list);

        foreach ($contents as $content) {
            if ($content[0] == 'Vorname' || $content[0] == 'Nachname' || $content[0] == 'Pfadiname') {
                unset($content);
            } else {
                if (! empty($content[6])) {
                    if ($content[6][0] == 'm') {
                        $gnd = 'Männlich';
                    } elseif ($content[6][0] == 'w') {
                        $gnd = 'Weiblich';
                    } elseif ($content[6][0] == 'u') {
                        $gnd = 'Anderes';
                    } else {
                        $gnd = null;
                    }
                } else {
                    $gnd = null;
                }

                if (! empty($content[7])) {
                    $carbon_birthday = Carbon::createFromFormat('d.m.Y', $content[7]);
                    $birthday = $carbon_birthday->format('Y-m-d');
                } else {
                    $birthday = '01.01.2000';
                }

                $barcode = Barcode::generateBarcode();

                isset($content[8]) ? $grp = DB::table('groups')->select('id')->where('group_name', 'LIKE', "%$content[8]%")->first() : $grp = null;
                DB::table('participations')->insert(['first_name' => utf8_encode($content[0]), 'last_name' => utf8_encode($content[1]), 'scout_name' => utf8_encode($content[2]), 'address' => utf8_encode($content[3]), 'plz' => $content[4], 'place' => utf8_encode($content[5]), 'gender' => $gnd, 'birthday' => $birthday, 'FK_GRP' => $grp, 'barcode' => $barcode]);
            }
        }

        return redirect()->back()->with('message', 'Die TN wurden importiert!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $pid
     *
     * @return Application|Factory|View
     */
    public function edit(int $pid)
    {
        $participations = DB::table('participations')->where('id', '=', $pid)->first();
        $groups = DB::table('groups')->select('groups.id', 'groups.group_name')->get();

        return view('participations.edit', ['participations' => $participations, 'groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $pid
     *
     * @return RedirectResponse
     */
    public function update(Request $request, int $pid)
    {
        $scout_name = $request->input('scout_name');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $plz = $request->input('plz');
        $place = $request->input('place');
        $birthday = $request->input('birthday');
        $gender = $request->input('gender');
        $group = $request->input('group');
        $barcode = $request->input('barcode');

        if ($gender) {
            if ($gender == 'm') {
                $gender = 'Männlich';
            } elseif ($gender == 'w') {
                $gender = 'Weiblich';
            } elseif ($gender == 'd') {
                $gender = 'Anderes';
            } else {
                $gender = null;
            }
        } else {
            $gender = null;
        }

        if ($request->file('tn_img')) {
            $img_name = 'tnimg_'.time().'.'.$request->file('tn_img')->extension();
            $request->file('tn_img')->move(storage_path('app/public/img'), $img_name);
        } else {
            $img_name = null;
        }

        $participant = Participant::find($pid);
        $participant->scout_name = $scout_name;
        $participant->first_name = $first_name;
        $participant->last_name = $last_name;
        $participant->barcode = $barcode;
        $participant->address = $address;
        $participant->plz = $plz;
        $participant->place = $place;
        $participant->birthday = $birthday;
        $participant->gender = $gender;
        $participant->FK_GRP = $group;
        if ($img_name != null) {
            $participant->person_picture = $img_name;
        }

        $participant->save();

        return redirect()->back()->with('message', 'Teilnehmer wurde aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $pid
     *
     * @return RedirectResponse
     */
    public function destroy(int $pid)
    {
        DB::table('participations')->where('id', '=', $pid)->delete();

        return redirect()->back()->with('message', 'Teilnehmer erfolgreich gelöscht.');
    }
}
