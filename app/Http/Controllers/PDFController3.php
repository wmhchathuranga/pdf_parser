<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;


class PDFController3 extends Controller
{
    public function upload(Request $request)
    {
        $pdfFilePath = storage_path('app/private/') .  $request->file('pdf')->store('pdfs');
        $parser = new Parser();
        $pdf = $parser->parseFile($pdfFilePath);
        $text = $pdf->getText();
        dd($text);
    }
}
