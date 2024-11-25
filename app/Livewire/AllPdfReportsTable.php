<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AllPdfReportsTable extends Component
{
    public $allReports;
    public $companies;
    public $selectedCompany;

    public function mount()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/companies');

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
            try {
                $response = Http::withHeaders([
                    'Authorization' => env('API_TOKEN'),
                ])->get(env('API_URL') . '/api/reports_5b/'.$this->companies[0]['abn']);

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

    public function changeCompany($abn){
        $this->selectedCompany = $abn;
        $this->loadData();
    }

    public function loadData(){
        if (!empty($this->companies)) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => env('API_TOKEN'),
                ])->get(env('API_URL') . '/api/reports_5b/'.$this->selectedCompany);

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

    public function render()
    {
        return view('livewire.all-pdf-reports-table', [
            'allReports' => $this->allReports,
            'companies' => $this->companies
        ]);
    }
}
