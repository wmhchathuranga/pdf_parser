<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function uploadAndForward(Request $request)
    {
        $request->validate([
            'pdfs' => 'required|array', // Ensure it's an array
            'pdfs.*' => 'file|mimes:pdf|max:2048', // Each file must be a PDF and max 2MB
        ]);        

        $pdfFiles = $request->file('pdfs');
        $pdfCount = count($pdfFiles);
        
        //tigger javascript function

        if (empty($pdfFiles)) {
            return view('cl/appendix-5b-upload', ['error' => 'No files were uploaded.']);
        }
        $responses = [];
        $successCount = 0;
        $errorCount = 0;

        foreach ($pdfFiles as $pdfFile) {
            $filePath = $pdfFile->store('temp'); // Stored in 'storage/app/temp'
            $fileContent = fopen(storage_path("app/{$filePath}"), 'r'); // Get file content

            $response = Http::withHeaders([
                'Authorization' => env('API_TOKEN'),
            ])->attach(
                'pdf',
                $fileContent,
                $pdfFile->getClientOriginalName()
            )->post(env('API_URL') . '/api/upload-pdf');

            fclose($fileContent);
            Storage::delete($filePath);

            $responses[] = [
                'file' => $pdfFile->getClientOriginalName(),
                'status' => $response->successful() ? 'success' : 'error',
                'message' => $response->successful() ? 'File forwarded successfully' : $response->body(),
            ];
            // dd($responses);
            if ($response->successful()) {
                $successCount++;
            }else{
                $errorCount++;
            }
        }

        return redirect('cl/appendix-5b-upload')
            ->with('responses', $responses)
            ->with('summary', "Successfully forwarded: {$successCount}, Failed: {$errorCount}");
    }
}
