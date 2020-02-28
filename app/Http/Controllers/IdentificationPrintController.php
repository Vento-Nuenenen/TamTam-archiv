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
		    'align' => 'R',
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

		    PDF::AddPage('L', 'A7');
		    !empty($person->scout_name) ? PDF::MultiCell(0, 0, $person->scout_name, 0, 'L') : PDF::MultiCell(0, 0, 'Kein Pfadiname angegeben', 0, 'L');
		    PDF::MultiCell(0, 10, $person->first_name . ' ' . $person->last_name, 0, 'L');
		    PDF::MultiCell(0, 0, $person->address, 0, 'L');
		    PDF::MultiCell(0, 10, $person->plz . ' ' . $person->place, 0, 'L');
		    PDF::MultiCell(0, 10, $birthday, 0, 'L');
		    PDF::MultiCell(0, 0, $person->gender, 0, 'L');

		    !empty($person->logo_file_name) ? PDF::Image(storage_path('/app/public/img/' . $person->logo_file_name), 65, 5, 30) : PDF::MultiCell(0, 60, 'Kein Bild gefunden', 0, 'R');
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', '50', '', 10, 0.4,$style ,'N') : PDF::MultiCell(0, 0, 'Kein Barcode gefunden', 0, 'R');
	    }

	    return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');
    }
}
