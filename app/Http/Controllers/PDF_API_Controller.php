<?php

namespace App\Http\Controllers;

use stdClass;
use Carbon\Carbon;
use App\Models\Companies;
use App\Models\PDFReport;
use App\Models\Appendix3X;
use Illuminate\Log\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PDF_API_Controller extends Controller
{

    private $table_names = ['operatingDetails', 'investingDetails', 'financingDetails', 'cashDetails', 'reconciliationDetails', 'relatedPartyPayments',  'financingFacilities', 'estimatedCashAvailabilities'];
    public function showReports($abn)
    {
        // exclude deleted reports

        $reports = PDFReport::where('abn', $abn)->whereNull('deleted_at')->get();
        foreach ($reports as $report) {
            $report->load(['operatingDetails', 'investingDetails', 'financingDetails', 'cashDetails', 'reconciliationDetails', 'relatedPartyPayments',  'financingFacilities', 'estimatedCashAvailabilities']);
        }
        return response()->json($reports);
    }

    public function showReports3x($abn)
    {
        $abn_suffix = substr(str_replace(' ', '', $abn), -9);
        $reports = Appendix3X::where('abn_suffix', $abn_suffix)->whereNull('deleted_at')->get();
        foreach ($reports as $report) {
            $report->load(['part1s', 'part2s', 'part3s']);
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

    public function showReport3x($id)
    {
        $report = Appendix3X::find($id);
        if (!$report || $report->deleted_at) {
            return response()->json(null, 404);
        }
        $report->load(['part1s', 'part2s', 'part3s']);
        return response()->json($report);
    }



    public function updateReport(Request $request)
    {
        $json = $request->all();
        $json_object = $json['data'];
        $report_id = $json_object['id'];

        $report = PDFReport::find($report_id);

        // Logger($report);
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

    public function updateReport3x(Request $request)
    {
        $json = $request->all();
        $json_object = $json['data'];
        $report_id = $json_object['id'];
        $abn_verified = false;

        $report = Appendix3X::find($report_id);
        if ($report['abn'] != $json_object['abn'] && $report['abn_verified'] == 0) {
            $is_valid_abn = $this->checkABN($json_object['abn']);

            if ($is_valid_abn) {
                $company = Companies::where('abn', $json_object['abn'])->first();
                $report['company_name'] = $company->name;
                $report['abn'] = $json_object['abn'];
                $report['abn_suffix'] = substr(str_replace(' ', '', $report['abn']), -9);
                $report['abn_verified'] = 1;
                $abn_verified = true;

                if ($company->stock_code != "" && $company->stock_exchange != "") {
                    $report['stock_code'] = $company->stock_code;
                    $report['stock_exchange'] = $company->stock_exchange;
                } else {
                    $company->stock_code = $report['stock_code'];
                    $company->stock_exchange = $report['stock_exchange'];
                    $company->save();
                }
            }
        } else {
            $abn_verified = true;
        }

        foreach ($json_object['part1s'] as $part1Data) {
            $part1Data['created_at'] = Carbon::parse($part1Data['created_at'])->format('Y-m-d H:i:s');
            $part1Data['updated_at'] = now();
            $report->part1s()->updateOrCreate(['id' => $part1Data['id']], $part1Data);
        }

        foreach ($json_object['part2s'] as $part2Data) {
            $part2Data['created_at'] = Carbon::parse($part2Data['created_at'])->format('Y-m-d H:i:s');
            $part2Data['updated_at'] = now();
            $report->part2s()->updateOrCreate(['id' => $part2Data['id']], $part2Data);
        }

        foreach ($json_object['part3s'] as $part3Data) {
            $part3Data['created_at'] = Carbon::parse($part3Data['created_at'])->format('Y-m-d H:i:s');
            $part3Data['updated_at'] = now();
            $report->part3s()->updateOrCreate(['id' => $part3Data['id']], $part3Data);
        }

        $report->save();

        $report = Appendix3X::find($report_id);
        if (!$report || $report->deleted_at) {
            return response()->json(null, 404);
        }
        $report->load(['part1s', 'part2s', 'part3s']);
        if (!$abn_verified) {
            return response()->json(['report_id' => $report_id, 'type' => '4', 'message' => 'ABN Not Verified'], 500);
        }
        return response()->json(['report_id' => $report_id, 'type' => '0', 'message' => 'Update Complete'], 200);
    }

    public function deleteReport($id)
    {
        $report = PDFReport::find($id);
        // soft delete
        $report->deleted_at = now();
        $report->save();
        return response()->json(["success"], 200);
    }

    public function deleteReport3x($id)
    {
        $report = Appendix3X::find($id);
        // soft delete
        $report->deleted_at = now();
        $report->save();
        return response()->json(["success"], 200);
    }

    public function showCompanies()
    {
        // exclude deleted companies
        $companies = PDFReport::selectRaw('MIN(id) as id, MAX(company_name) as company_name, abn')
            ->groupBy('abn')->whereNull('deleted_at')
            ->get();

        return response()->json($companies);
    }

    public function showCompanies3x()
    {
        // exclude deleted companies
        $companies = Appendix3X::selectRaw('MIN(id) as id,MAX(name_of_director) as name_of_director,MAX(company_name) as company_name, abn_suffix as abn')
            ->groupBy('abn_suffix')->whereNull('deleted_at')
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
        $data = PDFReport::where('abn', $abn)->whereNull('deleted_at')->whereBetween('quarter_ending', [$date_start, $date_end])->orderBy('quarter_ending', 'asc')->get();
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
                $column_data[] = $report[$this->table_names[$table_index]][0][$column] ?? 0;
            }

            $chart_data->{$column} = $column_data;
        }

        return response()->json($chart_data);
    }

    public function checkABN($abn)
    {

        $abn = str_replace('-', '', $abn);
        $abn = str_replace(' ', '', $abn);
        $abn_suffix = substr($abn, -9);
        $company = Companies::where('abn_suffix', $abn_suffix)->first();
        if ($company) {
            return true;
        }
        $URL = 'https://abr.business.gov.au/ABN/View?id=' . $abn;

        $response = Http::get($URL);
        Logger($response->body());

        if ($response->status() == 200) {
            // search for word "Error"
            if (strpos($response->body(), 'Error') !== false | strpos($response->body(), 'Invalid') !== false) {
                return false;
            }
            // check the http response body for "legalName"
            if (strpos($response->body(), 'legalName') !== false) {
                $company_name_string = preg_split("/legalName\">/", $response->body());
                $company_name = preg_split("/<\//", $company_name_string[1])[0];
                Companies::create([
                    'abn' => $abn,
                    'abn_suffix' => substr($abn, -9),
                    'name' => $company_name,
                ]);
            }
            return true;
        }
        return false;
    }
}
