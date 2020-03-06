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

	    $countpages = ceil(count($persons) / 6);
	    $personindex = 0;

	    for($i = 0; $i < $countpages; $i++){
	    	$carbon_birthday = Carbon::createFromFormat('Y-m-d',$persons[$personindex]->birthday);
	    	$birthday = $carbon_birthday->format('d.m.Y');

		    PDF::SetTitle(config('app.name') . " - Identifikationen");
		    PDF::SetFont('helvetica', 'B', 10);
		    PDF::SetCreator(config('app.name'));
		    PDF::SetAuthor(config('app.name'));
		    PDF::SetMargins(5, 5, 5, true);
		    PDF::SetAutoPageBreak(true, 5);

		    PDF::AddPage('P', 'A4');

		    $height = PDF::getPageHeight();
		    $width = PDF::getPageWidth();

		    #### Draw separator-lines on pages

		    PDF::Line(0, $height * 0.33, $width, $height * 0.33);
		    PDF::Line(0, $height * 0.66, $width, $height * 0.66);
		    PDF::Line($width * 0.5, 0, $width * 0.5, $height);

		    #### Card 1

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
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 55, 5, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(50, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 40, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    #### Card 2

		    PDF::SetMargins(110, 5, 5, true);
		    PDF::SetXY(110, 5);

		    !empty($person->scout_name) ? PDF::Cell(110, 0, $person->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->first_name) && !empty($person->first_name) ? PDF::Cell(110, 0, $person->first_name . ' ' . $person->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->address) ? PDF::Cell(0, 0, $person->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->plz) && !empty($person->place) ? PDF::Cell(0, 0, $person->plz . ' ' . $person->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->gender) ? PDF::Cell(0, 0, $person->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
		    PDF::SetXY(155, 5);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 160, 5, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(155, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 40, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    #### Card 3

		    PDF::SetMargins(5, 5, 5, true);
		    PDF::SetXY(5, 105);

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
		    PDF::SetXY(50, 105);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 55, 105, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(50, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 140, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    #### Card 4

		    PDF::SetMargins(110, 5, 5, true);
		    PDF::SetXY(110, 105);

		    !empty($person->scout_name) ? PDF::Cell(110, 0, $person->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->first_name) && !empty($person->first_name) ? PDF::Cell(110, 0, $person->first_name . ' ' . $person->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->address) ? PDF::Cell(0, 0, $person->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->plz) && !empty($person->place) ? PDF::Cell(0, 0, $person->plz . ' ' . $person->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->gender) ? PDF::Cell(0, 0, $person->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
		    PDF::SetXY(155, 105);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 160, 105, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(155, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 140, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');


		    #### Card 5

		    PDF::SetMargins(5, 5, 5, true);
		    PDF::SetXY(5, 200);

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
		    PDF::SetXY(50, 200);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 55, 200, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(50, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 235, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    #### Card 6

		    PDF::SetMargins(110, 5, 5, true);
		    PDF::SetXY(110, 200);

		    !empty($person->scout_name) ? PDF::Cell(110, 0, $person->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->first_name) && !empty($person->first_name) ? PDF::Cell(110, 0, $person->first_name . ' ' . $person->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->address) ? PDF::Cell(0, 0, $person->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->plz) && !empty($person->place) ? PDF::Cell(0, 0, $person->plz . ' ' . $person->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->gender) ? PDF::Cell(0, 0, $person->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
		    PDF::SetXY(155, 200);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 160, 200, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(155, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 235, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    PDF::AddPage('P', 'A4');

		    $height = PDF::getPageHeight();
		    $width = PDF::getPageWidth();

		    #### Draw separator-lines on pages

		    PDF::Line(0, $height * 0.33, $width, $height * 0.33);
		    PDF::Line(0, $height * 0.66, $width, $height * 0.66);
		    PDF::Line($width * 0.5, 0, $width * 0.5, $height);

		    #### Card 1

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
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 55, 5, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(50, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 40, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    #### Card 2

		    PDF::SetMargins(110, 5, 5, true);
		    PDF::SetXY(110, 5);

		    !empty($person->scout_name) ? PDF::Cell(110, 0, $person->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->first_name) && !empty($person->first_name) ? PDF::Cell(110, 0, $person->first_name . ' ' . $person->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->address) ? PDF::Cell(0, 0, $person->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->plz) && !empty($person->place) ? PDF::Cell(0, 0, $person->plz . ' ' . $person->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->gender) ? PDF::Cell(0, 0, $person->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
		    PDF::SetXY(155, 5);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 160, 5, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(155, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 40, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    #### Card 3

		    PDF::SetMargins(5, 5, 5, true);
		    PDF::SetXY(5, 105);

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
		    PDF::SetXY(50, 105);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 55, 105, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(50, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 140, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    #### Card 4

		    PDF::SetMargins(110, 5, 5, true);
		    PDF::SetXY(110, 105);

		    !empty($person->scout_name) ? PDF::Cell(110, 0, $person->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->first_name) && !empty($person->first_name) ? PDF::Cell(110, 0, $person->first_name . ' ' . $person->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->address) ? PDF::Cell(0, 0, $person->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->plz) && !empty($person->place) ? PDF::Cell(0, 0, $person->plz . ' ' . $person->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->gender) ? PDF::Cell(0, 0, $person->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
		    PDF::SetXY(155, 105);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 160, 105, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(155, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 140, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');


		    #### Card 5

		    PDF::SetMargins(5, 5, 5, true);
		    PDF::SetXY(5, 200);

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
		    PDF::SetXY(50, 200);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 55, 200, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(50, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 235, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

		    #### Card 6

		    PDF::SetMargins(110, 5, 5, true);
		    PDF::SetXY(110, 200);

		    !empty($person->scout_name) ? PDF::Cell(110, 0, $person->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->first_name) && !empty($person->first_name) ? PDF::Cell(110, 0, $person->first_name . ' ' . $person->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->address) ? PDF::Cell(0, 0, $person->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
		    PDF::Ln(5);
		    !empty($person->plz) && !empty($person->place) ? PDF::Cell(0, 0, $person->plz . ' ' . $person->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
		    PDF::Ln(10);
		    !empty($person->gender) ? PDF::Cell(0, 0, $person->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
		    PDF::SetXY(155, 200);
		    !empty($person->person_picture) ? PDF::Image(storage_path('/app/public/img/' . $person->person_picture), 160, 200, 30) : PDF::Cell(0, 0, 'Kein Profilbild gefunden', '', 0, 'L');
		    PDF::SetXY(155, 15);
		    !empty($person->barcode) ? PDF::write1DBarcode($person->barcode, 'EAN13', '', 235, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');

	    }

	    return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');
    }
}
