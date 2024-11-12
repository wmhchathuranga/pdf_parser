<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFController2;
use App\Http\Controllers\PDFController3;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/reports', [PDFController::class, 'showReports'])->name('reports');
Route::get('/report/{id}', [PDFController::class, 'showReport'])->name('report');
Route::get('/report_h/{id}', [PDFController::class, 'showReportH'])->name('report_h');

Route::get('/upload-pdf', function () {
    return view('upload_pdf');
});

Route::post('/upload-pdf-1', [PDFController::class, 'upload'])->name('upload-pdf-1');
Route::post('/upload-pdf-2', [PDFController2::class, 'upload'])->name('upload-pdf-2');
Route::post('/upload-pdf-3', [PDFController3::class, 'upload'])->name('upload-pdf-3');

Route::get('/tokens/create', function (Request $request) {
    $user = User::find($request->user_id);
    $token = $user->createToken("API Token");
    return response()->json([
        'token' => $token->plainTextToken
    ]);
});

require __DIR__.'/auth.php';
