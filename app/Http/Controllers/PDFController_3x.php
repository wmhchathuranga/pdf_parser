<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PDFController_3x extends Controller
{
    public function showReport3x($id){
        $response = Http::withHeaders([
            'Authorization' => env('API_TOKEN'),
        ])->get( env('API_URL').'/api/report_3x/'.$id);

        if($response->successful()){
            // dd($response->json());
            return view('cl.single-report-3x', ['reportData' => $response->json()]);
        }else{
            return view('cl.appendix-3x-upload', ['message' => 'No Report Found']);
        }
    }

    public function editReport3x($id){
        $response = Http::withHeaders([
            'Authorization' => env('API_TOKEN'),
        ])->get( env('API_URL').'/api/report_3x/'.$id);

        if($response->successful()){
            // dd($response->json());
            return view('cl.report-edit-3x', ['reportData' => $response->json()]);
        }else{
            return view('cl.appendix-3x-upload', ['message' => 'No Report Found']);
        }
    }

    public function saveReport3x(Request $request){
        $response = Http::withHeaders([
            'Authorization' => env('API_TOKEN'),
            'Content-Type' => 'application/json',
        ])->post( env('API_URL').'/api/report_3x', ['data' => $request->all()]);

        return $response->json();
        
    }
    
}