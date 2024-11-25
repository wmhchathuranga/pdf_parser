<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChartController extends Controller
{
    public function analyseChart(Request $request)
    {
        $validated = $request->validate([
            'abn' => 'required',
            'dateRange' => [
                'required',
                'regex:/^\d{2} \w{3},? \d{4}( to \d{2} \w{3},? \d{4})?$/',
            ],
            'topic' => 'required',
        ]);

        $abn = $validated['abn'];
        $dateRange = str_replace(',', '', $validated['dateRange']);
        if (strpos($dateRange, ' to ') !== false) {
            list($dateStart, $dateEnd) = explode(' to ', $dateRange);
        } else {
            $dateStart = $dateRange;
            $dateEnd = "";
        }

        list($tableIndex, $columnName) = explode('-', $validated['topic']);

        $requestBody = [
            "abn" => $abn,
            "date_start" => $dateStart,
            "date_end" => $dateEnd,
            "table_index" => $tableIndex,
            "columns" => [$columnName . "_c_q", $columnName . "_y_t_d"],
        ];

        $response = Http::withHeaders([
            'Authorization' => env('API_TOKEN'),
        ])->post(env('API_URL') . '/api/chart/1', $requestBody);

        if ($response->successful()) {
            $chartData = $response->json();
            return view('cl/single-pdf-chart', ['chartData' => $chartData]);
        } else {
            return redirect()->back()->withInput()->withErrors([
                'api_error' => 'Failed to fetch chart data.',
            ]);
        }
    }
}
