<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFController_3x;
use App\Http\Controllers\PDFController_3y;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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


// Routes for developers
Route::middleware(['auth', 'userPermissions'])->prefix('dev')->name('developer.')->group(function () {
    Route::get('/', [App\Http\Controllers\Developer\HomeController::class, 'index'])->name('dev.index');
    Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'prefixIndex'])->name('prefixIndex');

    {
        Route::get('all-reports', function () {
            return view('dev.all-reports');
        })->name('dev-all-reports');
    
        Route::get('all-clients', function () {
            return view('dev.all-clients');
        })->name('dev-all-clients');
    }
    // Other developer routes
});

// Routes for admins
Route::middleware(['auth', 'userPermissions'])->prefix('ad')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.index');
    Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'prefixIndex'])->name('prefixIndex');

    {
        Route::get('all-reports', function () {
            return view('ad.all-reports');
        })->name('all-reports');
    
        Route::get('all-clients', function () {
            return view('ad.all-clients');
        })->name('all-clients');
    }

    // Other admin routes
});

// Routes for clients
Route::middleware(['auth', 'userPermissions'])->prefix('cl')->name('client.')->group(function () {
    Route::get('/', [App\Http\Controllers\Client\HomeController::class, 'index'])->name('all-reports');
    Route::post('/upload-pdf', [PDFController::class, 'uploadAndForward'])->name('upload-pdf');

    // 5B 
    Route::get('/report_edit/{id}', [ReportController::class, 'editReport'])->name('report-edit');
    Route::get('/report_5b/{id}', [ReportController::class, 'showReport'])->name('single-report');
    Route::post('/save-report', [ReportController::class, 'saveReport'])->name('save-report');

    // 3X 
    Route::get('/report_3x/{id}', [PDFController_3x::class, 'showReport3x'])->name('single-report-3x');
    Route::get('/report_edit_3x/{id}', [PDFController_3x::class, 'editReport3x'])->name('report-edit-3x');
    Route::post('/save-report-3x', [PDFController_3x::class, 'saveReport3x'])->name('save-report-3x');

    // 3Y 
    Route::get('/report_3y/{id}', [PDFController_3y::class, 'showReport3y'])->name('single-report-3y');
    Route::get('/report_edit_3y/{id}', [PDFController_3y::class, 'editReport3y'])->name('report-edit-3y');
    Route::post('/save-report-3y', [PDFController_3y::class, 'saveReport3y'])->name('save-report-3y');


    Route::post('/single-pdf-chart-analyse', [ChartController::class, 'analyseChart'])->name('analyse-chart');

    {
        Route::get('appendix-5b-upload', function () {
            return view('cl.appendix-5b-upload');
        })->name('appendix-5b-upload');
        
        Route::get('appendix-3x-upload', function () {
            return view('cl.appendix-3x-upload');
        })->name('appendix-3x-upload');

        Route::get('appendix-3y-upload', function () {
            return view('cl.appendix-3y-upload');
        })->name('appendix-3y-upload');
        
        Route::get('comparison-table', function () {
            return view('cl.comparison-table');
        })->name('comparison-table');

        Route::get('comparison-table-3x', function () {
            return view('cl.comparison-table-3x');
        })->name('comparison-table-3x');
    
        Route::get('single-pdf-chart', function () {
            $companies = [];
            try{
                $response = Http::withHeaders([
                    'Authorization' => env('API_TOKEN'),
                ])->get(env('API_URL').'/api/companies');
    
                if($response->successful()){
                    $companies = $response->json();
                }
            }
            catch(Exception $e){
                dd($e->getMessage());
            }
            return view('cl.single-pdf-chart', ['comapaniesArray', $companies]);
            
        })->name('single-pdf-chart');
        Route::get('reports-compare-chart', function () {
            return view('cl.reports-compare-chart');
        })->name('reports-compare-chart');
    }

    Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'prefixIndex'])->name('prefixIndex');
});

// error route 

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('userPermissions');
