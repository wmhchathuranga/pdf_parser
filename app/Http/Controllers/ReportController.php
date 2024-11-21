<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    
    public function showReport($id){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 1|C4OuAgYlEpMo6XHA5Powq21v3RC4E3JBA3wCgX2p5f86ecf0',
        ])->get( env('API_URL').'/api/report_5b/'.$id);

        if($response->successful()){
            // dd($response->json());
            return view('cl.report', ['reportData' => $response->json()]);
        }else{
            return view('cl.all-reports', ['message' => 'No Report Found']);
        }
    }

    public function editReport($id){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 1|C4OuAgYlEpMo6XHA5Powq21v3RC4E3JBA3wCgX2p5f86ecf0',
        ])->get( env('API_URL').'/api/report_5b/'.$id);

        if($response->successful()){
            // dd($response->json());
            return view('cl.report-edit', ['reportData' => $response->json()]);
        }else{
            return view('cl.all-reports', ['message' => 'No Report Found']);
        }
    }

    public function saveReport(Request $request){
        // dd($request->all());
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 1|C4OuAgYlEpMo6XHA5Powq21v3RC4E3JBA3wCgX2p5f86ecf0',
            'Content-Type' => 'application/json',
        ])->post( env('API_URL').'/api/report_5b/', ['data' => $request->all()]);

        // dd($response->status());
        if($response->status() == 200){
            return response()->json($response->json());
        }else{
            return response()->json('error');
        }
        // if($response->successful()){
        //     return response()->json('message', 'Report Updated Successfully');
        // }else{
        //     return response()->json('message', 'Something went wrong');
        // }
    }

}
