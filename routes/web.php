<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\PDFController;
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


// menu routes
// client --
// {
//     Route::get('cl/appendix-5b-upload', function () {
//         return view('cl.appendix-5b-upload');
//     })->name('cl-appendix-5b-upload');
//     Route::get('cl/appendix-3x-upload', function () {
//         return view('cl.appendix-3x-upload');
//     })->name('cl-appendix-3x-upload');
//     Route::get('cl/all-reports', function () {
//         return view('cl.all-reports');
//     })->name('cl-all-reports');
//     Route::get('cl/comparison-table', function () {
//         return view('cl.comparison-table');
//     })->name('cl-comparison-table');

//     Route::get('cl/single-pdf-chart', function () {
//         $companies = [];
//         try{
//             $response = Http::withHeaders([
//                 'Authorization' => env('API_TOKEN'),
//             ])->get(env('API_URL').'/api/companies');

//             if($response->successful()){
//                 $companies = $response->json();
//             }
//         }
//         catch(Exception $e){
//             dd($e->getMessage());
//         }
//         return view('cl.single-pdf-chart', ['comapaniesArray', $companies]);
        
//     })->name('cl-single-pdf-chart');
// }

// admin --
// {
//     Route::get('ad/all-reports', function () {
//         return view('ad.all-reports');
//     })->name('ad-all-reports');

//     Route::get('ad/all-clients', function () {
//         return view('ad.all-clients');
//     })->name('ad-all-clients');
// }

// developer --
// {
//     Route::get('dev/all-reports', function () {
//         return view('dev.all-reports');
//     })->name('dev-all-reports');

//     Route::get('dev/all-clients', function () {
//         return view('dev.all-clients');
//     })->name('dev-all-clients');
// }

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

    Route::get('/report_edit/{id}', [ReportController::class, 'editReport'])->name('report-edit');
    Route::get('/report_5b/{id}', [ReportController::class, 'showReport'])->name('single-report');
    Route::post('/save-report', [ReportController::class, 'saveReport'])->name('save-report');

    Route::post('/single-pdf-chart-analyse', [ChartController::class, 'analyseChart'])->name('analyse-chart');

    {
        Route::get('appendix-5b-upload', function () {
            return view('cl.appendix-5b-upload');
        })->name('appendix-5b-upload');
        Route::get('appendix-3x-upload', function () {
            return view('cl.appendix-3x-upload');
        })->name('appendix-3x-upload');
        Route::get('all-reports', function () {
            return view('cl.all-reports');
        })->name('all-reports');
        Route::get('comparison-table', function () {
            return view('cl.comparison-table');
        })->name('comparison-table');
    
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
    }

    Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'prefixIndex'])->name('prefixIndex');
});

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('userPermissions');
