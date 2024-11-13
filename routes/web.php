<?php

use App\Http\Controllers\PDFController;
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

// Route::get('/upload-pdf', function () {
//     return view('upload-pdf');
// });



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
Route::middleware(['auth', 'userPermissions'])->prefix('cl')->group(function () {
    Route::get('/', [App\Http\Controllers\Client\HomeController::class, 'index'])->name('client.all-reports');
    Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'prefixIndex'])->name('prefixIndex');
});

// Route::get('/all-reports', function () {
//     return view('all-reports');
// })-> name('all-reports')->middleware('isAdmin');

// Route::get('/dashboard-analytics', function () {
//     return view('dashboard-analytics');
// })-> name('dashboard-analytics')->middleware('isDeveloper');

// Route::get('/pdf-upload', function () {
//     return view('pdf-upload');
// })-> name('pdf-upload')->middleware('isAdmin');


Route::post('/upload-pdf', [PDFController::class, 'uploadAndForward'])->name('upload-pdf');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('userPermissions');
