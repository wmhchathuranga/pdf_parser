<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FetchReport extends Component
{

    public $companies;
    public $selectedCompany;
    public $allReports;
    public $type;

    public $selectedStatus;

    public function mount()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/companies/' . $this->type);

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
                ])->get(env('API_URL') . '/api/reports_5b/' . $this->companies[0]['abn']);

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
    }

    public function changeCompany($abn)
    {
        $this->selectedCompany = $abn;
        // $this->loadData();
    }

    public function changeStatus($status)
    {
        $this->selectedStatus = $status;
    }

    public function deleteReport($id)
    {
        // dd($id);
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/report_5b/delete/' . $id);
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
        // dd($this->type);
        if (!empty($this->companies)) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => env('API_TOKEN'),
                ])->get(env('API_URL') . '/api/reports_' . $this->type . '/' . $this->selectedCompany);

                if ($response->successful()) {
                    if ($this->selectedStatus == null) {
                        $this->selectedCompany = $this->companies[0]['abn'];
                    }
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
        $this->loadData();
        // dd($this->allReports);
        return view('livewire.fetch-report');
    }
}
