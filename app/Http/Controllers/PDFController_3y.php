<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PDFController_3y extends Controller
{
    public function showReport3y($id)
{
    // $response = Http::withHeaders([
    //     'Authorization' => env('API_TOKEN'),
    // ])->get(env('API_URL') . '/api/report_3y/' . $id);

    // if ($response->successful()) {
    //     return view('cl.single-report-3y', ['reportData' => $response->json()]);
    // } else {
    //     return view('cl.appendix-3y-upload', ['message' => 'No Report Found']);
    // }
    return view('cl.single-report-3y');
}

public function editReport3y($id){
    // $response = Http::withHeaders([
    //     'Authorization' => env('API_TOKEN'),
    // ])->get( env('API_URL').'/api/report_3y/'.$id);

    // if($response->successful()){
    //     // dd($response->json());
    //     return view('cl.report-edit-3y', ['reportData' => $response->json()]);
    // }else{
    //     return view('cl.appendix-3y-upload', ['message' => 'No Report Found']);
    // }
    return view('cl.report-edit-3y');
}

public function saveReport3y(Request $request){
    $response = Http::withHeaders([
        'Authorization' => env('API_TOKEN'),
        'Content-Type' => 'application/json',
    ])->post( env('API_URL').'/api/report_3x', ['data' => $request->all()]);

    // dd($response->status());
    if($response->status() == 200){
        return response()->json($response->json());
    }else{
        return response()->json('error');
    }
}

}
