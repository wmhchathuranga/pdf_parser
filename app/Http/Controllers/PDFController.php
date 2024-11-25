<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function uploadAndForward(Request $request)
    {
        // Step 1: Validate the uploaded files
        $request->validate([
            'pdfs.*' => 'required|file|mimes:pdf|max:2048', // Each file must be a PDF and max 2MB
        ]);

        // Step 2: Get all uploaded files
        $pdfFiles = $request->file('pdfs');

        // Check if any files were uploaded
        if (empty($pdfFiles)) {
            return view('cl/appendix-5b-upload', ['error' => 'No files were uploaded.']);
        }

        // Array to store response statuses for each file
        $responses = [];

        foreach ($pdfFiles as $pdfFile) {
            // Process each file as before
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
        }

        // Return summary
        $successCount = count(array_filter($responses, fn($r) => $r['status'] === 'success'));
        $errorCount = count($responses) - $successCount;

        return redirect('cl/appendix-5b-upload')
            ->with('responses', $responses)
            ->with('summary', "Successfully forwarded: {$successCount}, Failed: {$errorCount}");
    }
}
