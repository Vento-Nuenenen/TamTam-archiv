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
        return view('gratulation.gratulation');
    }

    public function export(Request $request)
    {
        $persons = DB::table('participations')->where('course_passed', '=', true)->get();

        foreach ($persons as $person) {
            $text = $request->certificate_text;

            if (isset($person->scout_name)) {
                $text = str_replace('@name', $person->scout_name, $text);
            } else {
                $text = str_replace('@name', $person->first_name, $text);
            }

            $text = Helper::br2nl($text);

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
