<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SinglePdfChart extends Component
{
    public $companies = [];
    public $selectedComapny;

    public function loadCompanies(){

        try{
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL').'/api/companies');
    
            if($response->successful()){
                $this->companies = $response->json();
            }else{
                dd($response->json());
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.single-pdf-chart', ['comapaniesArray', $this->companies]);
    }
}
