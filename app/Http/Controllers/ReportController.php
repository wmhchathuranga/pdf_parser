<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    
    public function showReport($id){
        $response = Http::withHeaders([
            'Authorization' => env('API_TOKEN'),
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
            'Authorization' => env('API_TOKEN'),
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
        $successCount = 0;
        $errorCount = 0;
        foreach($request->all() as $report){
            
            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
                'Content-Type' => 'application/json',
            ])->post( env('API_URL').'/api/report_5b', ['data' => $report]);
    
            // dd($response->status());
            if($response->status() == 200){
                // return response()->json($response->json());
                $successCount++;
            }else{
                // return response()->json('error');
                $errorCount++;
            }
            
        }

                return response()->json($successCount.' reports updated successfully  ||  '.$errorCount.' reports failed ', 200);

        // if($response->successful()){
        //     return response()->json('message', 'Report Updated Successfully');
        // }else{
        //     return response()->json('message', 'Something went wrong');
        // }
    }

}
