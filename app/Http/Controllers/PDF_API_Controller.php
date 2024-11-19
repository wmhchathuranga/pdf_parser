<?php

namespace App\Http\Controllers;

use App\Models\PDFReport;
use Illuminate\Http\Request;

class PDF_API_Controller extends Controller
{

    public function showReports()
    {
        $reports = PDFReport::all();
        return response()->json($reports);
    }

    public function showReport($id)
    {
        $report = PDFReport::find($id);
        return response()->json($report);
    }

    public function updateReport(Request $request, $id)
    {
        $report = PDFReport::find($id);
        $report->update($request->all());
        return response()->json($report);
    }

    public function deleteReport($id)
    {
        $report = PDFReport::find($id);
        $report->delete();
        return response()->json(null, 204);
    }
}
