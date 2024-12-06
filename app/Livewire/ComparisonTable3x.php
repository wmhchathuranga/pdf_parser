<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComparisonTable3x extends Component
{
    public $allReports;
    public $companies;
    public $selectedCompany;

    public function mount()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/companies/3x');

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
                ])->get(env('API_URL') . '/api/reports_3x/' . $this->companies[0]['abn']);

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
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/reports_3x/' . $this->selectedCompany);

            if ($response->successful()) {
                $this->allReports = $response->json();
            } else {
                throw new Exception('Failed to fetch reports');
            }
        } catch (Exception $e) {
            abort(500, 'Something went wrong');
        }
    }

    public function rendered(){
        $this->dispatch('refreshTable');
    }
    
    public function render()
    {
        $this->loadData();
        return view('livewire.comparison-table3x');
    }
}
