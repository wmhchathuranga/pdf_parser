<?php

namespace App\Livewire;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SinglePdfChart extends Component
{
    public $companies = [];
    public $selectedCompany = '';
    public $selectedDateRange = '';
    public $selectedTopic = '';
    public $tables = ["Cash flows from operating activities","Cash flows from investing activities","Cash flows from financing activities","Cash flow details","Reconciliation details","Related party payments","Financing facilities","Estimated cash availabilities"];
    public $tableIndex;
    public $chartData = [];

    public function mount()
    {
        $this->loadCompanies(); {
            $firstDayOfYear = Carbon::now()->startOfYear();

            $today = Carbon::now();

            $formattedFirstDay = $firstDayOfYear->format('d M, Y');
            $formattedToday = $today->format('d M, Y');

            // $this->selectedDateRange = $formattedFirstDay . ' to ' . $formattedToday;
            $this->selectedDateRange = "01 Jan, 2022 to 01 Jan, 2024";
        }
    }

    public function changeCompany($abn)
    {
        $this->selectedCompany = $abn;
    }
    public function changeTopic($topic)
    {
        $this->selectedTopic = $topic;
    }

    public function loadCompanies()
    {

        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/companies/5b');

            if ($response->successful()) {
                $this->companies = $response->json();
            } else {
                abort(500, 'Something went wrong');
            }
        } catch (Exception $e) {
            throw new Exception('Failed to fetch companies');
        }
    }

    public function analyzeChart()
    {
        //vaidation
        if (empty($this->selectedCompany) || $this->selectedCompany == "") {
            // dd('1');
            return session()->flash('error', 'Please select a company.');
        } elseif (empty($this->selectedTopic) || $this->selectedTopic == "") {
            // dd('2');
            return session()->flash('error', 'Please select a topic.');
        }
        if (
            empty($this->selectedDateRange) ||
            $this->selectedDateRange == "" ||
            preg_match('/^\d{2} \w{3},? \d{4}( to \d{2} \w{3},? \d{4})?$/', $this->selectedDateRange) == false
        ) {
            // dd($this->selectedDateRange);
            return session()->flash('error', 'Please select a date range.');
        } else {
            // dd($this->selectedDateRange, $this->selectedTopic, $this->selectedCompany);

            $abn = $this->selectedCompany;
            $this->selectedDateRange = str_replace(',', '', $this->selectedDateRange);
            if (strpos($this->selectedDateRange, ' to ') !== false) {
                list($dateStart, $dateEnd) = explode(' to ', $this->selectedDateRange);
            } else {
                $dateStart = $this->selectedDateRange;
                $dateEnd = "";
            }
            list($this->tableIndex, $columnName) = explode('-', $this->selectedTopic);

            $requestBody = [
                "abn" => $abn,
                "date_start" => $dateStart,
                "date_end" => $dateEnd,
                "table_index" => $this->tableIndex,
                "columns" => [$columnName . "_c_q", $columnName . "_y_t_d"],

            ];
            
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->post(env('API_URL') . '/api/chart/1', $requestBody);

            if ($response->successful()) {
                // dd($requestBody ,$response->json());
                $this->chartData = $response->json();
                return view('livewire.single-pdf-chart', [
                    'chartData' => $this->chartData
                ]);
                // json to string
                // $this->chartData = json_encode($this->chartData);
            } else {
                abort(500, 'Something went wrong');
            }
        }
    }

    public function render()
    {
        // dd($this->companies[0]['abn']);
        return view('livewire.single-pdf-chart');
    }
}
