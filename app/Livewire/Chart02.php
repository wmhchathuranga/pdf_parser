<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Chart02 extends Component
{
    public $reportsData;
    public $companies;
    public $selectedCompany;
    // public $selectedYear;
    // public $selectedTable;

    // public $barTopics;
    // public $barValues;



    public function mount()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/companies/5b');

            if ($response->successful()) {
                $this->companies = $response->json();
            } else {
                throw new Exception('Failed to fetch companies');
            }
        } catch (Exception $e) {
            abort(500, 'Something went wrong');
        }
        // $this->selectedYear = date('Y');
        if(!empty($this->companies)){
            $this->selectedCompany = $this->companies[0]['abn'];
            $this->fetchReportsData();
        }else{
            $this->selectedCompany = '';
            $this->reportsData = [];
        }
    }

    public function changeCompany( $abn ){
        $this->selectedCompany = $abn;
        $this->fetchReportsData();
    }

    public function fetchReportsData()
    {
        $response = Http::withHeaders([
            'Authorization' => env('API_TOKEN'),
        ])->get(env('API_URL') . '/api/reports_5b/' . $this->selectedCompany);

        if ($response->successful()) {
            $this->reportsData = $response->json();
            // dd($this->reportsData);
        } else {
            throw new Exception('Failed to fetch reports');
        }
    }

    public function rendered()
    {
        $this->dispatch('refreshChart', reportsData: $this->reportsData);
    }

    public function render()
    {
        return view('livewire.chart02');
    }
}
