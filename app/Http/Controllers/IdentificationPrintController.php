<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use PDF;

class IdentificationPrintController extends Controller
{
    public function index(){
		return view('identification.identification');
    }

    public function export(Request $request){
	    // define barcode style
	    $style = array(
		    'align' => 'L',
		    'stretch' => false,
		    'text' => true,
	    );

	    $persons = DB::table('participations')->leftJoin('groups', 'participations.FK_GRP', 'groups.id')->get();

	    foreach ($persons as $person) {
	    	$carbon_birthday = Carbon::createFromFormat('Y-m-d',$person->birthday);
	    	$birthday = $carbon_birthday->format('d.m.Y');

		    PDF::SetTitle(config('app.name') . " - Identifikationen");
		    PDF::SetFont('helvetica', 'B', 10);
		    PDF::SetCreator(config('app.name'));
		    PDF::SetAuthor(config('app.name'));
		    PDF::SetMargins(5, 5, 5, true);
		    PDF::SetAutoPageBreak(true, 5);

		    PDF::AddPage('P', 'A4');
		    !empty($person->scout_name) ? PDF::Cell(0, 0, $person->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->first_name) && !empty($person->first_name) ? PDF::Cell(0, 0, $person->first_name . ' ' . $person->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->address) ? PDF::Cell(0, 0, $person->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->plz) && !empty($person->place) ? PDF::Cell(0, 0, $person->plz . ' ' . $person->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->gender) ? PDF::Cell(0, 0, $person->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
		    PDF::SetXY(50, 5);
		    !empty($person->logo_file_name) ? PDF::Image(storage_path('/app/public/img/' . $person->logo_file_name), 65, 5, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(50, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', '40', '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');
	    }

	    return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');
    }
}
