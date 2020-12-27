<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use PDF;

class PrintPricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('pricelist.pricelist');
    }

    public function print()
    {
        // define barcode style
        $style = [
            'align' => 'L',
            'stretch' => false,
            'text' => true,
        ];

        $items = Items::all();

        PDF::SetTitle(config('app.name').' - Preisliste');
        PDF::SetFont('helvetica', '', 10);
        PDF::SetCreator(config('app.name'));
        PDF::SetAuthor(config('app.name'));
        PDF::SetMargins(10, 10, 10, true);
        PDF::SetAutoPageBreak(true, 5);

        // Custom Header
        PDF::setHeaderCallback(function($pdf) {
            // Position at 15 mm from top
            $pdf->SetY(15);
            // Set font
            $pdf->SetFont('helvetica', 'B', 25);
            // Title
            $pdf->Cell(0, 15, 'Preisliste - Kiosk', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        });

        // Custom Footer
        PDF::setFooterCallback(function($pdf) {
            // Position at 15 mm from bottom
            $pdf->SetY(-10);
            // Set font
            $pdf->SetFont('helvetica', 'I', 8);
            // Page number
            $pdf->Cell(0, 0, 'Seite ' . $pdf->getAliasNumPage() . ' / ' . $pdf->getAliasNbPages(), 0, 0, 'C');
        });

        PDF::AddPage('P', 'A4');

        $width = PDF::getPageWidth();
        $currentHeight = 25;

        PDF::SetY($currentHeight);

        PDF::Line(0, $currentHeight, $width, $currentHeight);

        PDF::SetFont('helvetica', 'B', 15);
        PDF::Cell($width / 3, 5, "Artikelname", '', 0, 'L');
        PDF::Cell($width / 3, 5, "Artikelpreis", '', 0, 'L');
        PDF::Cell($width / 3, 5, "Barcode", '', 0, 'L');
        PDF::SetFont('helvetica', '', 10);
        PDF::Ln(14);
        $currentHeight += 8;

        foreach($items as $item){
            PDF::Line(0, $currentHeight, $width, $currentHeight);
            PDF::Cell($width / 3, 0, $item->item_name, '', 0, 'L');
            PDF::Cell($width / 3, 0, $item->item_price, '', 0, 'L');
            PDF::write1DBarcode($item->item_barcode, 'EAN13', ($width / 3) * 2, $currentHeight + 1, 0, 10, 0.4, $style);
            PDF::Ln(12);
            $currentHeight += 16;
        }
        PDF::Line(0, $currentHeight, $width, $currentHeight);

        return response(PDF::Output(), 200)->header('Content-Type', 'application/pdf');
    }
}
