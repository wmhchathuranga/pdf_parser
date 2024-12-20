<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComparisonTable extends Component


{
    public $allReports;
    public $companies;
    public $selectedCompany;
    public $tableTopic;
    public $timeType;

    public function mount()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/companies/5b');

            if ($response->successful()) {
                // dd($response->json());
                $this->companies = $response->json();
            } else {
                throw new Exception('Failed to fetch companies');
            }
        } catch (Exception $e) {
            abort(500, 'Something went wrong');
        }

        if (!empty($this->companies)) {
            if (isset($_COOKIE['5b_company_comparison_abn'])) {
                $this->selectedCompany = $_COOKIE['5b_company_comparison_abn'];
            } else {
                $this->selectedCompany = $this->companies[0]['abn'];
            }
            try {
                $response = Http::withHeaders([
                    'Authorization' => env('API_TOKEN'),
                ])->get(env('API_URL') . '/api/reports_5b/' . $this->selectedCompany);

                if ($response->successful()) {
                    $this->allReports = $response->json();
                } else {
                    throw new Exception('Failed to fetch reports');
                }
            } catch (Exception $e) {
                abort(500, 'Something went wrong');
            }
        } else {
            // dd('No companies available.');
        }

        $this->tableTopic = 'all';
        $this->timeType = '0';
    }

    public function changeCompany($abn)
    {
        $this->selectedCompany = $abn;
        setcookie('5b_company_comparison_abn', $abn, 0, "/");
        $this->loadData();
    }

    public function changetimeType($timeType){
        $this->timeType = $timeType;
    }

    public function changeTableTopic($tableTopic)
    {
        if($tableTopic == '5' || $tableTopic == '6' || $tableTopic == '7'){
            $this->timeType = '1';
        }
        $this->tableTopic = $tableTopic;
    }

    public function loadData()
    {
        if (!empty($this->companies)) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => env('API_TOKEN'),
                ])->get(env('API_URL') . '/api/reports_5b/' . $this->selectedCompany);

                if ($response->successful()) {
                    $this->selectedCompany = $this->companies[0]['abn'];
                    $this->allReports = $response->json();
                } else {
                    throw new Exception('Failed to fetch reports');
                }
            } catch (Exception $e) {
                abort(500, 'Something went wrong');
            }
        } else {
            // dd('No companies available.');
        }
    }

    public function rendered(){
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.comparison-table', [
            'allReports' => $this->allReports,
            'companies' => $this->companies
        ]);
    }
}
