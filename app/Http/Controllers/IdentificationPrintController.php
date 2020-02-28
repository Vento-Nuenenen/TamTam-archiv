<?php

namespace App\Http\Controllers;

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
		    'align' => 'R',
		    'stretch' => false,
		    'text' => true,
	    );

	    $persons = DB::table('participations')->leftJoin('groups', 'participations.FK_GRP', 'groups.id')->get();

	    foreach ($persons as $person) {
		    PDF::SetTitle(config('app.name') . " - Identifikationen");
		    PDF::SetFont('helvetica', 'B', 10);
		    PDF::SetCreator(config('app.name'));
		    PDF::SetAuthor(config('app.name'));
		    PDF::SetMargins(5, 5, 5, true);
		    PDF::SetAutoPageBreak(true, 5);

		    PDF::AddPage('L', 'A7');
		    !empty($person->scout_name) ? PDF::MultiCell(0, 0, $person->scout_name, 0, 'L') : PDF::MultiCell(0, 0, 'Kein Pfadiname angegeben', 0, 'L');
		    PDF::MultiCell(0, 10, $person->first_name . ' ' . $person->last_name, 0, 'L');
		    PDF::MultiCell(0, 0, $person->address, 0, 'L');
		    PDF::MultiCell(0, 10, $person->plz . ' ' . $person->place, 0, 'L');
		    PDF::MultiCell(0, 10, $person->birthday, 0, 'L');
		    PDF::MultiCell(0, 10, $person->gender, 0, 'L');

		    !empty($person->logo_file_name) ? PDF::Image(storage_path('/app/public/img/' . $person->logo_file_name), 60, 5) : PDF::MultiCell(0, 60, 'Kein Bild gefunden');

		    PDF::write1DBarcode('1234567890128', 'EAN13', '', '50', '', 10, 0.4,$style ,'N');
	    }

	    return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');
    }
}
