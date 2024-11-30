<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ComparisonTable3x extends Component
{
    public $allReports;

    public function loadData(){
        try {
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL') . '/api/reports_3x');

            if ($response->successful()) {
                $this->allReports = $response->json();
            } else {
                dd($response);
                throw new Exception('Failed to fetch reports');
            }
        } catch (Exception $e) {
            abort(500, 'Something went wrong');
        }
    }
    
    public function render()
    {
        $this->loadData();
        return view('livewire.comparison-table3x');
    }
}
