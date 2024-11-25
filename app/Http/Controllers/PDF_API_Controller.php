<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PDFReport;
use Illuminate\Http\Request;
use stdClass;

class PDF_API_Controller extends Controller
{

    private $table_names = ['operatingDetails', 'investingDetails', 'financingDetails', 'cashDetails', 'reconciliationDetails', 'relatedPartyPayments',  'financingFacilities', 'estimatedCashAvailabilities'];
    public function showReports($abn)
    {
        $reports = PDFReport::all()->where('abn', str_replace(' ', '', $abn));
        foreach ($reports as $report) {
            $report->load(['operatingDetails', 'investingDetails', 'financingDetails', 'cashDetails', 'reconciliationDetails', 'relatedPartyPayments',  'financingFacilities', 'estimatedCashAvailabilities']);
        }
        return response()->json($reports);
    }

    public function showReport($id)
    {
        $report = PDFReport::find($id);
        if (!$report || $report->deleted_at) {
            return response()->json(null, 404);
        }
        $report->load(['operatingDetails', 'investingDetails', 'financingDetails', 'cashDetails', 'reconciliationDetails', 'relatedPartyPayments',  'financingFacilities', 'estimatedCashAvailabilities']);
        return response()->json($report);
    }

    public function updateReport(Request $request)
    {
        $json = $request->all();
        $json_object = $json['data'];
        $report_id = $json_object['id'];

        $report = PDFReport::find($report_id);
        $opertingDetails = $json_object['operating_details'][0];
        $opertingDetails['created_at'] = Carbon::parse($opertingDetails['created_at'])->format('Y-m-d H:i:s');
        $opertingDetails['updated_at'] = now();

        $investingDetails = $json_object['investing_details'][0];
        $investingDetails['created_at'] = Carbon::parse($investingDetails['created_at'])->format('Y-m-d H:i:s');
        $investingDetails['updated_at'] = now();

        $financingDetails = $json_object['financing_details'][0];
        $financingDetails['created_at'] = Carbon::parse($financingDetails['created_at'])->format('Y-m-d H:i:s');
        $financingDetails['updated_at'] = now();

        $cashDetails = $json_object['cash_details'][0];
        $cashDetails['created_at'] = Carbon::parse($cashDetails['created_at'])->format('Y-m-d H:i:s');
        $cashDetails['updated_at'] = now();

        $reconciliationDetails = $json_object['reconciliation_details'][0];
        $reconciliationDetails['created_at'] = Carbon::parse($reconciliationDetails['created_at'])->format('Y-m-d H:i:s');
        $reconciliationDetails['updated_at'] = now();

        $relatedPartyPayments = $json_object['related_party_payments'][0];
        $relatedPartyPayments['created_at'] = Carbon::parse($relatedPartyPayments['created_at'])->format('Y-m-d H:i:s');
        $relatedPartyPayments['updated_at'] = now();

        $financingFacilities = $json_object['financing_facilities'][0];
        $financingFacilities['created_at'] = Carbon::parse($financingFacilities['created_at'])->format('Y-m-d H:i:s');
        $financingFacilities['updated_at'] = now();

        $estimatedCashAvailabilities = $json_object['estimated_cash_availabilities'][0];
        $estimatedCashAvailabilities['created_at'] = Carbon::parse($estimatedCashAvailabilities['created_at'])->format('Y-m-d H:i:s');
        $estimatedCashAvailabilities['updated_at'] = now();

        logger($opertingDetails);
        $report->operatingDetails()->update($opertingDetails);
        $report->investingDetails()->update($investingDetails);
        $report->financingDetails()->update($financingDetails);
        $report->cashDetails()->update($cashDetails);
        $report->reconciliationDetails()->update($reconciliationDetails);
        $report->relatedPartyPayments()->update($relatedPartyPayments);
        $report->financingFacilities()->update($financingFacilities);
        $report->estimatedCashAvailabilities()->update($estimatedCashAvailabilities);
        $report->save();

        $report = PDFReport::find($report_id);
        if (!$report || $report->deleted_at) {
            return response()->json(null, 404);
        }
        $report->load(['operatingDetails', 'investingDetails', 'financingDetails', 'cashDetails', 'reconciliationDetails', 'relatedPartyPayments',  'financingFacilities', 'estimatedCashAvailabilities']);
        return response()->json($report, 200);
    }

    public function deleteReport($id)
    {
        $report = PDFReport::find($id);
        $report->delete();
        return response()->json(null, 204);
    }

    public function showCompanies()
    {
        $companies = PDFReport::selectRaw('MIN(id) as id, MAX(company_name) as company_name, abn')
            ->groupBy('abn')
            ->get();

        return response()->json($companies);
    }

    public function chart1(Request $request)
    {
        $request_data = $request->all();
        $abn = $request_data['abn'];
        $date_start = $request_data['date_start'];
        $date_start = Carbon::parse($date_start)->format('Y-m-d');
        $date_end = $request_data['date_end'];
        $date_end = Carbon::parse($date_end)->format('Y-m-d');
        $data = PDFReport::where('abn', $abn)->whereBetween('quarter_ending', [$date_start, $date_end])->get();
        $table_index = $request_data['table_index'];
        foreach ($data as $report) {
            $report->load($this->table_names[$table_index]);
        }
        $chart_data = new stdClass();

        $quarter_ending = [];
        $table_name = $this->table_names[$table_index];
        foreach ($data as $report) {
            $quarter_ending[] = $report->quarter_ending;
        }
        $chart_data->x_axis = $quarter_ending;

        $columns_requested = $request_data['columns'];

        foreach ($columns_requested as $column) {
            $column_data = [];
            foreach ($data as $report) {
                $column_data[] = $report[$this->table_names[$table_index]][0][$column]??0;
            }

            $chart_data->{$column} = $column_data;
        }

        return response()->json($chart_data);
    }
}
