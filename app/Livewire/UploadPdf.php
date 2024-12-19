<?php

namespace App\Livewire;

use App\Models\ActivityLog;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPdf extends Component
{
    use WithFileUploads; // Add this line

    public $pdfFormat;
    public $pdfFiles = [];
    public $type;

    public $pdfCount = 0;
    public $successCount;
    public $errorCount;
    public $errorDetails = [];
    public $notifications = [];



    public function uploadPDF()
    {
        $validatedData = $this->validate([
            'pdfFiles.*' => 'file|mimes:pdf|max:5120', // 5MB max per file
        ]);

        // Reset counters
        $this->successCount = 0;
        $this->errorCount = 0;
        $this->errorDetails;
        $this->pdfCount = count($this->pdfFiles);

        foreach ($this->pdfFiles as $pdfFile) {
            $filePath = $pdfFile->store('temp');
            $fileContent = fopen(storage_path("app/{$filePath}"), 'r');

            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->attach(
                'pdf',
                $fileContent,
                $pdfFile->getClientOriginalName()
            )->post(env('API_URL') . '/api/upload-pdf/' . $this->type);
                
            // fclose($fileContent);
            Storage::delete($filePath);
            if ($response->successful()) {
                $this->successCount++;
            } else {
                $errorDetail = [
                    'name' => $pdfFile->getClientOriginalName(),
                    'message' => $response->json()['message'],
                ];
                $this->createObject($response);
                array_push($this->errorDetails, $errorDetail);
                $this->errorCount++;
            }

            $this->saveActivity($response);
        }

        if($this->notifications != []){
            $this->saveNotifications();
        }

        $this->pdfFiles = [];
        session()->flash('message', [
            'success' => $this->successCount,
            'error' => $this->errorCount,
        ]);
    }



    public function createObject($errorData){
        // dd($errorData->json());
        $errorData = $errorData->json();
        $object = [
            'file_name' => $errorData['file_name'] ?? null,
            'report_id' => $errorData['report_id']  ?? null,
            'type' => $errorData['type'],
            'message' => $errorData['message'],
        ];    
        // $object = [
        //     'report_id' => '1',
        //     'type' => 'scrap faild',
        //     'message' => $errorData[0],
        // ];    

        $this->notifications[] = $object;
    }

    public function saveNotifications(){
        foreach ($this->notifications as $key => $object) {
            Notification::create([
                'user_id' => auth()->user()->id,
                'file_name' => $object['file_name'],
                'report_id' => $object['report_id'],
                'report_type' => $this->type,
                'type' => $object['type'],
                'message' => $object['message'],
            ]);
        }
    }


    public function saveActivity($response){
        $responseAll = $response->json();
        // dd($response);
        // for($i = 0; $i < count($responseAll); $i++){
        //     // dd($response[$i]);
        //     $response = json_encode($responseAll[$i]);
        //     ActivityLog::create([
        //         'user_id' => auth()->user()->id,
        //         'status_message' => $response[$i]['message'],
        //         'director' => $response[$i]['director'],
        //         'date_of_appointment' => $response[$i]['date_of_appointment'],
        //         'error_type' => $response[$i]['type'],
        //         'description' => $response[$i]['file_name'],
        //         'ip_address' => request()->ip(),
        //         'user_agent' => request()->header('User-Agent'),
        //         'report_id' => $response[$i]['report_id'] ?? null,
        //         'report_type' => $this->type
        //     ]);
        // }
        
        foreach($responseAll as $response){
            // dd($response);
            $response = json_decode($response, true);
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'status_message' => $response['message'],
                'director' => $response['director'],
                'date_of_appointment' => Carbon::parse($response['date_of_appointment'])->format('Y-m-d'),
                'error_type' => $response['type'],
                'description' => $response['file_name'],
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'report_id' => $response['report_id'] ?? null,
                'report_type' => $this->type
            ]);
        }
        
    }


    public function clearMessage()
    {
        session()->forget('message');
    }


    public function render()
    {
        return view('livewire.upload-pdf');
    }
}
