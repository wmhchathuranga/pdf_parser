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
            // check has any cookie or not
            if (isset($_COOKIE['3x_company_abn'])) {
                $this->selectedCompany = $_COOKIE['3x_company_abn'];
            } else {
                $this->selectedCompany = $this->companies[0]['abn'];
            }

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

    public function changeCompany($abn)
    {
        //set cookie
        setcookie('3x_company_abn', $abn, 0, "/");
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

                //i want to check companies has selected company
                if (!in_array($this->selectedCompany, array_column($this->companies, 'abn'))) {
                    if (count($this->companies) > 0) {
                        $this->selectedCompany = $this->companies[0]['abn'];
                    }
                    setcookie('3x_company_abn', '', time() - 3600, "/");
                    // setcookie('3x_company_abn', $this->selectedCompany, 0, "/");
                }
                if (!empty($_COOKIE['3x_company_comparison_abn']) && count($this->companies) > 0) {
                    $cookieValue = $_COOKIE['3x_company_comparison_abn'];
                    $abnList = array_column($this->companies, 'abn');
                
                    if (!in_array($cookieValue, $abnList)) {
                        setcookie('3x_company_comparison_abn', '', time() - 3600, "/");
                    }
                }
                


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
