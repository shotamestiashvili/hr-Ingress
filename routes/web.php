<?php

use App\Http\Controllers\Api\ExportController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('vue');
});

Route::get('/test', function () {
    return view('test');
});

// Route::get('/vue', function () {
//     return view('vue');
// });

// Route::get('/test', AttendanceController);

//Route::get('/upload-file', [FileUpload::class, 'createForm']);

Route::post('/upload-file', [\App\Http\Controllers\Api\ImportController::class, 'importSchedule'])->name('fileUpload');


Route::get('/currency',   [AttendanceController::class, 'currency']);
Route::get('/carbon',    [AttendanceController::class, 'test']);
Route::get('/workhour',    [AttendanceController::class, 'worktypeTime']);
Route::get('/export',    [ExportController::class, 'exportSchedule']);

Route::get('/refresh',    [AttendanceController::class, 'refresh']);
Route::get('/generate',   [AttendanceController::class, 'statisticGenerate']);
Route::get('/monthly',    [AttendanceController::class, 'monthlyGrid']);
Route::get('/newuser',    [AttendanceController::class, 'newUserGrid']);


