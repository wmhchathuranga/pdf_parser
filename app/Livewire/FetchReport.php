<?php

namespace App\Livewire;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class FetchReport extends Component
{

    public $jsonData = [];

    public function loadData(){
        try{
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->get(env('API_URL').'/api/reports_5b');

            if($response->successful()){
                // dd($response->json());
                $this->jsonData = $response->json();
                // dd($this->jsonData[0]['abn']);
            }
        }
        catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function render()
    {
        $this->loadData();
        return view('livewire.fetch-report');
    }
}