<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FetchReports3x extends Component
{
    public $allReports;
    public $companies = [];
    public $selectedCompany;

    public $selectedStatus;

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

        // dd($this->companies);
        if (!empty($this->companies)) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => env('API_TOKEN'),
                ])->get(env('API_URL') . '/api/reports_3x/'. $this->companies[0]['abn'] );

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

        $this->selectedStatus = 'all';
        $this->loadData();
    }

    public function changeStatus($status)
    {
        $this->selectedStatus = $status;
    }

    public function changeCompany($abn){
        $this->selectedCompany = $abn;
        $this->loadData();
    }

    public function deleteReport($id)
    {
        // dd($id);
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/report_3x/delete/' . $id);
            // dd($response);
            if ($response->successful()) {
                $this->loadData();
            } else {
                // dd($response);
                abort(500, 'Something went wrong');
            }
        } catch (Exception $e) {
            // dd($id);
            abort(500, 'Something went wrong');
        }
        // $this->loadData();
    }

    public function loadData()
    {
        if (!empty($this->selectedCompany)) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => env('API_TOKEN'),
                ])->get(env('API_URL') . '/api/reports_3x/'. $this->selectedCompany);
    
                if ($response->successful()) {
                    $this->allReports = $response->json();
                } else {
                    throw new Exception('Failed to fetch reports');
                }
            } catch (Exception $e) {
                abort(500, 'Something went wrong');
            }
        }
    }

    public function rendered()
    {
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.fetch-reports3x', [
            'allReports' => $this->allReports,
        ]);
    }
}
