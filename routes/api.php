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
    Route::get('/companies/5b', [PDF_API_Controller::class, 'showCompanies'])->name('companies');
    Route::get('/companies/3x', [PDF_API_Controller::class, 'showCompanies3x'])->name('directors');

    // Appendix 5B
    Route::post('/upload-pdf/5b', [PDFController::class, 'upload'])->name('upload-pdf-5b');
    Route::get('/reports_5b/{abn}', [PDF_API_Controller::class, 'showReports'])->name('reports')->where('abn', '[0-9]+');
    Route::get('/report_5b/{id}', [PDF_API_Controller::class, 'showReport'])->name('report')->where('id', '[0-9]+');
    Route::POST('/report_5b', [PDF_API_Controller::class, 'updateReport'])->name('report-update');
    Route::get('/report_5b/delete/{id}', [PDF_API_Controller::class, 'deleteReport'])->name('report')->where('id', '[0-9]+');
    
    // Appendix 3X
    Route::post('/upload-pdf/3x', [PDFController2::class, 'upload'])->name('upload-pdf-3x');
    Route::get('/reports_3x/{abn}', [PDF_API_Controller::class, 'showReports3x'])->name('reports')->where('abn', '[0-9]+');
    Route::get('/report_3x/{id}', [PDF_API_Controller::class, 'showReport3x'])->name('report')->where('id', '[0-9]+');
    Route::POST('/report_3x', [PDF_API_Controller::class, 'updateReport3x'])->name('report-update');
    Route::get('/report_3x/delete/{id}', [PDF_API_Controller::class, 'deleteReport3x'])->name('report')->where('id', '[0-9]+');

    Route::post('chart/1', [PDF_API_Controller::class, 'chart1'])->name('chart-1');
    
});