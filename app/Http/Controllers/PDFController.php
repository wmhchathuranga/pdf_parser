<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function uploadAndForward(Request $request)
    {
        // Step 1: Validate the uploaded file
        // $request->validate([
        //     'pdf' => 'required|file|mimes:pdf|max:2048', // Validate for PDF format, max 2MB
        // ]);
        

        // Step 2: Get the uploaded file
        $pdfFile = $request->file('pdf');

        // Option 1: Save temporarily in local storage (optional)
        $filePath = $pdfFile->store('temp'); // Stored in 'storage/app/temp'

        // Step 3: Forward the file to another API
        // Read the file content if you're not saving it, or get the path if you saved it
        $fileContent = fopen(storage_path("app/{$filePath}"), 'r'); // Get file content

        // Send the file to the internal or external API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer 1|C4OuAgYlEpMo6XHA5Powq21v3RC4E3JBA3wCgX2p5f86ecf0',
        ])->attach(
            'pdf',
            $fileContent,
            $pdfFile->getClientOriginalName()
        )->post(env('API_URL').'/api/upload-pdf');

        // Close the file after sending it
        // fclose($fileContent);

        // Step 4: Delete the local file if saved temporarily
        Storage::delete($filePath);

        // Step 5: Return the response from the other API or handle as needed
        if ($response->successful()) {
            return view('cl\appendix-5b-upload', ['success' => 'PDF forwarded successfully']);
            // return response()->json(['message' => 'PDF forwarded successfully'], 200);
        } else {
            return view('cl\appendix-5b-upload', ['error' => $response]);
            // return response()->json(['error' => $response], $response->status());
        }
    }
    
}
