<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFController2;
use App\Http\Controllers\PDF_API_Controller;



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // get unique companies
    Route::get('/companies', [PDF_API_Controller::class, 'showCompanies'])->name('companies');
    Route::post('/upload-pdf', [PDFController::class, 'upload'])->name('upload-pdf');
    Route::get('/reports_5b/{abn}', [PDF_API_Controller::class, 'showReports'])->name('reports')->where('abn', '[0-9]+');
    Route::get('/report_5b/{id}', [PDF_API_Controller::class, 'showReport'])->name('report')->where('id', '[0-9]+');
    Route::POST('/report_5b', [PDF_API_Controller::class, 'updateReport'])->name('report-update');
    Route::get('/report_5b/delete/{id}', [PDF_API_Controller::class, 'deleteReport'])->name('report')->where('id', '[0-9]+');
    
});