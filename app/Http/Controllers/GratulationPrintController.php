<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use DB;
use Illuminate\Http\Request;
use PDF;

class GratulationPrintController extends Controller
{
    public function index()
    {
        $text = file_get_contents(storage_path('app/template/gratulation.txt'));

        return view('gratulation.gratulation', ['text' => $text]);
    }

    public function export(Request $request)
    {
        if ($request->action == 'save') {
            file_put_contents(storage_path('app/template/gratulation.txt'), $request->certificate_text);

            return redirect()->back()->with('message', 'Neuer Text wurde gespeichert!');
        } elseif ($request->input('action') == 'print') {
            $persons = DB::table('participations')->where('course_passed', '=', true)->get();

            foreach ($persons as $person) {
                $text = $request->certificate_text;
                $title = '';

                if (substr($person->gender, 0, 1) == 'M') {
                    $title = 'Lieber';
                } elseif (substr($person->gender, 0, 1) == 'W') {
                    $title = 'Liebe';
                } elseif (substr($person->gender, 0, 1) == 'A') {
                    $title = 'Liebe';
                }

                if (isset($person->scout_name)) {
                    $text = str_replace('@name', $person->scout_name, $text);
                } else {
                    $text = str_replace('@name', $person->first_name, $text);
                }

                $text = str_replace('@title', $title, $text);

                PDF::SetTitle(config('app.name'));
                PDF::SetFont('helvetica', 'B', 18);
                PDF::SetCreator(config('app.name'));
                PDF::SetAuthor(config('app.name'));
                PDF::SetTopMargin(50);

                PDF::AddPage();
                PDF::MultiCell(0, 10, $text, 0, 'C');
            }

            return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');
        }
    }
}
