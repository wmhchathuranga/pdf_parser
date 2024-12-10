<?php

namespace App\Livewire;

use App\Models\Notification;
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

    public $responsesData = [];

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

                // dd($errorDetail, $response->json());
                array_push($this->errorDetails, $errorDetail);
                $this->errorCount++;
            }
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





    // $errorData->json() = [{
    //     'report_id': '1',
    //     'type': 'scrap faild',
    //     'message' : 'Failed to scrap'
    // }]

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


    public function clearMessage()
    {
        session()->forget('message');
    }


    public function render()
    {
        return view('livewire.upload-pdf');
    }
}
