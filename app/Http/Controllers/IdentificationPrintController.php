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

	    $persons = DB::table('participations')->get();

	    foreach ($persons as $person) {
		    PDF::SetTitle(config('app.name') . " - Identifikationen");
		    PDF::SetFont('helvetica', 'B', 10);
		    PDF::SetCreator(config('app.name'));
		    PDF::SetAuthor(config('app.name'));
		    PDF::SetMargins(5, 5, 5, true);
		    PDF::SetAutoPageBreak(true, 5);

		    PDF::AddPage('L', 'A7');
		    PDF::MultiCell(0, 0, $person->scout_name, 0, 'L');
		    PDF::MultiCell(0, 10, $person->first_name . ' ' . $person->last_name, 0, 'L');
		    PDF::MultiCell(0, 0, $person->address, 0, 'L');
		    PDF::MultiCell(0, 10, $person->plz . ' ' . $person->place, 0, 'L');
		    PDF::MultiCell(0, 10, $person->birthday, 0, 'L');
		    PDF::MultiCell(0, 10, $person->gender, 0, 'L');

		    $imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
		    PDF::Image('@'.$imgdata, 60, 5);


		    PDF::write1DBarcode('1234567890128', 'EAN13', '', '50', '', 10, 0.4,$style ,'N');
	    }

	    return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');


    }
}
