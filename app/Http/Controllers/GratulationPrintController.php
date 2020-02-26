<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Helper\Helper;
use PDF;

class GratulationPrintController extends Controller
{
	public function index(){
		return view('gratulation.gratulation');
	}

	public function export(Request $request){
		$users = DB::table('participations')->get();

		foreach ($users as $user) {
			$text = $request->certificate_text;

			if (isset($user->scout_name)) {
				$text = str_replace('@name', $user->scout_name, $text);
			} else {
				$text = str_replace('@name', $user->first_name, $text);
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
