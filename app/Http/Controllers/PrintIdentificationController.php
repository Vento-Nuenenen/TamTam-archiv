<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use PDF;

class PrintIdentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('identification.identification');
    }

    public function print()
    {
        // define barcode style
        $style = [
            'align' => 'L',
            'stretch' => false,
            'text' => true,
        ];

        $persons = DB::table('participations')
            ->leftJoin('groups', 'participations.FK_GRP', 'groups.id')->get();
        $numbers = EmergencyNumber::orderBy('order', 'ASC')->get();

        $countpages = ceil(count($persons) / 6);
        $personindex = 0;

        PDF::SetTitle(config('app.name').' - Identifikationen');
        PDF::SetFont('helvetica', 'B', 10);
        PDF::SetCreator(config('app.name'));
        PDF::SetAuthor(config('app.name'));
        PDF::SetMargins(5, 5, 5, true);

        for ($i = 0; $i < $countpages; $i++) {
            PDF::AddPage('P', 'A4', false, false);

            PDF::SetFont('helvetica', 'B', 10);
            PDF::SetMargins(5, 5, 5, true);

            $height = PDF::getPageHeight();
            $width = PDF::getPageWidth();

            //### Draw separator-lines on pages
            PDF::Line(0, $height * 0.33, $width, $height * 0.33);
            PDF::Line(0, $height * 0.66, $width, $height * 0.66);
            PDF::Line($width * 0.5, 0, $width * 0.5, $height);

            //### Card 1
            if ($personindex <= count($persons)) {
                $birthday = Helpers::calc_birthday($persons, $personindex);

                PDF::SetXY(5, 5);
                ! empty($persons[$personindex]->scout_name) ? PDF::Cell(0, 0, $persons[$personindex]->scout_name, '', 0, 'L') : PDF::Cell(0, 0, '-', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->first_name) && ! empty($persons[$personindex]->last_name) ? PDF::Cell(0, 0, $persons[$personindex]->first_name.' '.$persons[$personindex]->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->address) ? PDF::Cell(0, 0, $persons[$personindex]->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->plz) && ! empty($persons[$personindex]->place) ? PDF::Cell(0, 0, $persons[$personindex]->plz.' '.$persons[$personindex]->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->gender) ? PDF::Cell(0, 0, $persons[$personindex]->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
                PDF::SetXY(60, 5);
                ! empty($persons[$personindex]->person_picture) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->person_picture), 65, 5, 30) : PDF::Cell(0, 0, ' ', '', 0, 'L');
                PDF::SetXY(60, 15);
                ! empty($persons[$personindex]->barcode) ? PDF::write1DBarcode($persons[$personindex]->barcode, 'EAN13', '', 40, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');
                PDF::SetXY(30, 70);
                ! empty($persons[$personindex]->logo_file_name) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->logo_file_name), 30, 60, 45) : PDF::Cell(0, 0, 'Kein Gruppen-Logo gefunden', '', 0, 'L');
            }
            $personindex++;

            //### Card 2
            PDF::SetMargins(110, 5, 5, true);
            PDF::SetXY(110, 5);

            if ($personindex < count($persons)) {
                $birthday = Helpers::calc_birthday($persons, $personindex);

                ! empty($persons[$personindex]->scout_name) ? PDF::Cell(110, 0, $persons[$personindex]->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->first_name) && ! empty($persons[$personindex]->last_name) ? PDF::Cell(110, 0, $persons[$personindex]->first_name.' '.$persons[$personindex]->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->address) ? PDF::Cell(0, 0, $persons[$personindex]->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->plz) && ! empty($persons[$personindex]->place) ? PDF::Cell(0, 0, $persons[$personindex]->plz.' '.$persons[$personindex]->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->gender) ? PDF::Cell(0, 0, $persons[$personindex]->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
                PDF::SetXY(165, 5);
                ! empty($persons[$personindex]->person_picture) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->person_picture), 170, 5, 30) : PDF::Cell(0, 0, ' ', '', 0, 'L');
                PDF::SetXY(165, 15);
                ! empty($persons[$personindex]->barcode) ? PDF::write1DBarcode($persons[$personindex]->barcode, 'EAN13', '', 40, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');
                PDF::SetXY(135, 70);
                ! empty($persons[$personindex]->logo_file_name) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->logo_file_name), 140, 60, 45) : PDF::Cell(0, 0, 'Kein Gruppen-Logo gefunden', '', 0, 'L');
            }

            $personindex++;

            //### Card 3
            PDF::SetMargins(5, 5, 5, true);
            PDF::SetXY(5, 105);

            if ($personindex < count($persons)) {
                $birthday = Helpers::calc_birthday($persons, $personindex);

                ! empty($persons[$personindex]->scout_name) ? PDF::Cell(0, 0, $persons[$personindex]->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->first_name) && ! empty($persons[$personindex]->last_name) ? PDF::Cell(0, 0, $persons[$personindex]->first_name.' '.$persons[$personindex]->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->address) ? PDF::Cell(0, 0, $persons[$personindex]->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->plz) && ! empty($persons[$personindex]->place) ? PDF::Cell(0, 0, $persons[$personindex]->plz.' '.$persons[$personindex]->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->gender) ? PDF::Cell(0, 0, $persons[$personindex]->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
                PDF::SetXY(60, 105);
                ! empty($persons[$personindex]->person_picture) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->person_picture), 65, 105, 30) : PDF::Cell(0, 0, ' ', '', 0, 'L');
                PDF::SetXY(60, 15);
                ! empty($persons[$personindex]->barcode) ? PDF::write1DBarcode($persons[$personindex]->barcode, 'EAN13', '', 140, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');
                PDF::SetXY(30, 160);
                ! empty($persons[$personindex]->logo_file_name) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->logo_file_name), 30, 160, 45) : PDF::Cell(0, 0, 'Kein Gruppen-Logo gefunden', '', 0, 'L');
            }

            $personindex++;

            //### Card 4
            PDF::SetMargins(110, 5, 5, true);
            PDF::SetXY(110, 105);

            if ($personindex < count($persons)) {
                $birthday = Helpers::calc_birthday($persons, $personindex);

                ! empty($persons[$personindex]->scout_name) ? PDF::Cell(110, 0, $persons[$personindex]->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->first_name) && ! empty($persons[$personindex]->last_name) ? PDF::Cell(110, 0, $persons[$personindex]->first_name.' '.$persons[$personindex]->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->address) ? PDF::Cell(0, 0, $persons[$personindex]->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->plz) && ! empty($persons[$personindex]->place) ? PDF::Cell(0, 0, $persons[$personindex]->plz.' '.$persons[$personindex]->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->gender) ? PDF::Cell(0, 0, $persons[$personindex]->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
                PDF::SetXY(165, 105);
                ! empty($persons[$personindex]->person_picture) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->person_picture), 170, 105, 30) : PDF::Cell(0, 0, ' ', '', 0, 'L');
                PDF::SetXY(165, 15);
                ! empty($persons[$personindex]->barcode) ? PDF::write1DBarcode($persons[$personindex]->barcode, 'EAN13', '', 140, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');
                PDF::SetXY(135, 160);
                ! empty($persons[$personindex]->logo_file_name) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->logo_file_name), 140, 160, 45) : PDF::Cell(0, 0, 'Kein Gruppen-Logo gefunden', '', 0, 'L');
            }

            $personindex++;

            //### Card 5
            PDF::SetMargins(5, 5, 5, true);
            PDF::SetXY(5, 200);

            if ($personindex < count($persons)) {
                $birthday = Helpers::calc_birthday($persons, $personindex);

                ! empty($persons[$personindex]->scout_name) ? PDF::Cell(0, 0, $persons[$personindex]->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->first_name) && ! empty($persons[$personindex]->last_name) ? PDF::Cell(0, 0, $persons[$personindex]->first_name.' '.$persons[$personindex]->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->address) ? PDF::Cell(0, 0, $persons[$personindex]->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->plz) && ! empty($persons[$personindex]->place) ? PDF::Cell(0, 0, $persons[$personindex]->plz.' '.$persons[$personindex]->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->gender) ? PDF::Cell(0, 0, $persons[$personindex]->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
                PDF::SetXY(60, 200);
                ! empty($persons[$personindex]->person_picture) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->person_picture), 65, 200, 30) : PDF::Cell(0, 0, ' ', '', 0, 'L');
                PDF::SetXY(60, 15);
                ! empty($persons[$personindex]->barcode) ? PDF::write1DBarcode($persons[$personindex]->barcode, 'EAN13', '', 235, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');
                PDF::SetXY(30, 255);
                ! empty($persons[$personindex]->logo_file_name) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->logo_file_name), 30, 255, 45) : PDF::Cell(0, 0, 'Kein Gruppen-Logo gefunden', '', 0, 'L');
            }

            $personindex++;

            //### Card 6
            PDF::SetMargins(110, 5, 5, true);
            PDF::SetXY(110, 200);

            if ($personindex < count($persons)) {
                $birthday = Helpers::calc_birthday($persons, $personindex);

                ! empty($persons[$personindex]->scout_name) ? PDF::Cell(110, 0, $persons[$personindex]->scout_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Pfadiname gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->first_name) && ! empty($persons[$personindex]->last_name) ? PDF::Cell(110, 0, $persons[$personindex]->first_name.' '.$persons[$personindex]->last_name, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Vor & Nachname gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->address) ? PDF::Cell(0, 0, $persons[$personindex]->address, '', 0, 'L') : PDF::Cell(0, 0, 'Keine Adresse gefunden', '', 0, 'L');
                PDF::Ln(5);
                ! empty($persons[$personindex]->plz) && ! empty($persons[$personindex]->place) ? PDF::Cell(0, 0, $persons[$personindex]->plz.' '.$persons[$personindex]->place, '', 0, 'L') : PDF::Cell(0, 0, 'Kein PLZ & Ort gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($birthday) ? PDF::Cell(0, 0, $birthday, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geburtstag gefunden', '', 0, 'L');
                PDF::Ln(10);
                ! empty($persons[$personindex]->gender) ? PDF::Cell(0, 0, $persons[$personindex]->gender, '', 0, 'L') : PDF::Cell(0, 0, 'Kein Geschlecht gefunden', '', 0, 'L');
                PDF::SetXY(165, 200);
                ! empty($persons[$personindex]->person_picture) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->person_picture), 170, 200, 30) : PDF::Cell(0, 0, ' ', '', 0, 'L');
                PDF::SetXY(165, 15);
                ! empty($persons[$personindex]->barcode) ? PDF::write1DBarcode($persons[$personindex]->barcode, 'EAN13', '', 235, '', 10, 0.4, $style, 'L') : PDF::Cell(0, 0, 'Kein Barcode gefunden', '', 0, 'L');
                PDF::SetXY(135, 255);
                ! empty($persons[$personindex]->logo_file_name) ? PDF::Image(storage_path('/app/public/img/'.$persons[$personindex]->logo_file_name), 140, 255, 45) : PDF::Cell(0, 0, 'Kein Gruppen-Logo gefunden', '', 0, 'L');
            }

            $personindex++;

            PDF::AddPage('P', 'A4', false, false);

            $height = PDF::getPageHeight();
            $width = PDF::getPageWidth();

            //### Draw separator-lines on emergency-number pages
            PDF::Line(0, $height * 0.33, $width, $height * 0.33);
            PDF::Line(0, $height * 0.66, $width, $height * 0.66);
            PDF::Line($width * 0.5, 0, $width * 0.5, $height);

            PDF::SetMargins(5, 5, 5, true);
            PDF::SetXY(5, 5);

            //### emergency-numbers 1
            PDF::SetFontSize(20);
            PDF::Cell(0, 0, 'Notfallnummern:', '', 0, 'L');
            PDF::SetFontSize(12);
            PDF::Ln(10);

            foreach ($numbers as $number) {
                PDF::Cell(0, 0, $number->name.': '.$number->number, '', 0, 'L');
                PDF::Ln(6);
            }

            //### emergency-numbers 2
            PDF::SetMargins(110, 5, 5, true);
            PDF::SetXY(110, 5);

            PDF::SetFontSize(20);
            PDF::Cell(0, 0, 'Notfallnummern:', '', 0, 'L');
            PDF::SetFontSize(12);
            PDF::Ln(10);

            foreach ($numbers as $number) {
                PDF::Cell(0, 0, $number->name.': '.$number->number, '', 0, 'L');
                PDF::Ln(6);
            }

            //### emergency-numbers 3
            PDF::SetMargins(5, 5, 5, true);
            PDF::SetXY(5, 105);

            PDF::SetFontSize(20);
            PDF::Cell(0, 0, 'Notfallnummern:', '', 0, 'L');
            PDF::SetFontSize(12);
            PDF::Ln(10);

            foreach ($numbers as $number) {
                PDF::Cell(0, 0, $number->name.': '.$number->number, '', 0, 'L');
                PDF::Ln(6);
            }

            //### emergency-numbers 4
            PDF::SetMargins(110, 5, 5, true);
            PDF::SetXY(110, 105);

            PDF::SetFontSize(20);
            PDF::Cell(0, 0, 'Notfallnummern:', '', 0, 'L');
            PDF::SetFontSize(12);
            PDF::Ln(10);

            foreach ($numbers as $number) {
                PDF::Cell(0, 0, $number->name.': '.$number->number, '', 0, 'L');
                PDF::Ln(6);
            }

            //### emergency-numbers 5
            PDF::SetMargins(5, 5, 5, true);
            PDF::SetXY(5, 200);

            PDF::SetFontSize(20);
            PDF::Cell(0, 0, 'Notfallnummern:', '', 0, 'L');
            PDF::SetFontSize(12);
            PDF::Ln(10);

            foreach ($numbers as $number) {
                PDF::Cell(0, 0, $number->name.': '.$number->number, '', 0, 'L');
                PDF::Ln(6);
            }

            //### emergency-numbers 6
            PDF::SetMargins(110, 5, 5, true);
            PDF::SetXY(110, 200);

            PDF::SetFontSize(20);
            PDF::Cell(0, 0, 'Notfallnummern:', '', 0, 'L');
            PDF::SetFontSize(12);
            PDF::Ln(10);

            foreach ($numbers as $number) {
                PDF::Cell(0, 0, $number->name.': '.$number->number, '', 0, 'L');
                PDF::Ln(6);
            }
        }

        return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');
    }
}
