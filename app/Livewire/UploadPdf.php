<?php

namespace App\Livewire;

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



    public function uploadPDF()
    {
        $validatedData = $this->validate([
            'pdfFiles.*' => 'file|mimes:pdf|max:5120', // 5MB max per file
        ]);

        // Reset counters
        $this->successCount = 0;
        $this->errorCount = 0;

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

            fclose($fileContent);
            Storage::delete($filePath);

            if ($response->successful()) {
                $this->successCount++;
            } else {
                // dd($response, $this->type);
                $this->errorCount++;
            }
        }

        $this->pdfFiles = [];
        // Set session flash message with counts
        session()->flash('message', [
            'success' => $this->successCount,
            'error' => $this->errorCount,
        ]);
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
