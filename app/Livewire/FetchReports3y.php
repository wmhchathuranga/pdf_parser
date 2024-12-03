<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FetchReports3y extends Component
{
    public $allReports;

    public $selectedStatus;

    public function mount()
    {
        $this->selectedStatus = 'all';
        $this->loadData();
    }

    public function changeStatus($status){
        $this->selectedStatus = $status;
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
        // dd('end ponit not fixed');
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/reports_3x');

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
        return view('livewire.fetch-reports3y');
    }
}
