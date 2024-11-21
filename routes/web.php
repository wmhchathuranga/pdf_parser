<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//Language Translation

Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root')->middleware('userPermissions');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('/reports', [PDFController::class, 'showReports'])->name('reports');
Route::get('/report/{id}', [PDFController::class, 'showReport'])->name('report');
Route::get('/report_h/{id}', [PDFController::class, 'showReportH'])->name('report_h');



// menu routes
// client --
{
    Route::get('cl/appendix-5b-upload', function () {
        return view('cl.appendix-5b-upload');
    })->name('cl-appendix-5b-upload');
    Route::get('cl/appendix-3x-upload', function () {
        return view('cl.appendix-3x-upload');
    })->name('cl-appendix-3x-upload');
    Route::get('cl/all-reports', function () {
        return view('cl.all-reports');
    })->name('cl-all-reports');

    Route::get('cl/charts', function () {
        return view('cl.charts');
    })->name('cl-charts');
}

// admin --
{
    Route::get('ad/all-reports', function () {
        return view('ad.all-reports');
    })->name('ad-all-reports');

    Route::get('ad/all-clients', function () {
        return view('ad.all-clients');
    })->name('ad-all-clients');
}

// developer --
{
    Route::get('dev/all-reports', function () {
        return view('dev.all-reports');
    })->name('dev-all-reports');

    Route::get('dev/all-clients', function () {
        return view('dev.all-clients');
    })->name('dev-all-clients');
}

// Routes for developers
Route::middleware(['auth', 'userPermissions'])->prefix('dev')->group(function () {
    Route::get('/', [App\Http\Controllers\Developer\HomeController::class, 'index'])->name('dev.index');
    Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'prefixIndex'])->name('prefixIndex');
    // Other developer routes
});

// Routes for admins
Route::middleware(['auth', 'userPermissions'])->prefix('ad')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.index');
    Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'prefixIndex'])->name('prefixIndex');
    // Other admin routes
});

// Routes for clients
Route::middleware(['auth', 'userPermissions'])->prefix('cl')->name('client.')->group(function () {
    Route::get('/', [App\Http\Controllers\Client\HomeController::class, 'index'])->name('all-reports');
    Route::post('/upload-pdf', [PDFController::class, 'uploadAndForward'])->name('upload-pdf');

    Route::get('report_edit/{id}', [ReportController::class, 'editReport'])->name('report-edit');
    Route::get('/report_5b/{id}', [ReportController::class, 'showReport'])->name('single-report');
    Route::post('/save-report', [ReportController::class, 'saveReport'])->name('save-report');

    Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'prefixIndex'])->name('prefixIndex');
});

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('userPermissions');
