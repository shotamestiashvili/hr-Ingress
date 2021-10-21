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

// Route::get('/test', AttendanceController);

//Route::get('/upload-file', [FileUpload::class, 'createForm']);

Route::post('/upload-file', [\App\Http\Controllers\Api\ImportController::class, 'importSchedule'])->name('fileUpload');


//Route::get('/test',    [AttendanceController::class, 'test']);
Route::get('/time',    [AttendanceController::class, 'timeService']);
Route::get('/job',         [AttendanceController::class, 'test']);
Route::get('/workhour',    [AttendanceController::class, 'worktypeTime']);
Route::get('/export',      [ExportController::class, 'exportSchedule']);
Route::POST('/import',      [AttendanceController::class, 'import'])->name('import');

Route::get('/dailyinout',       [AttendanceController::class, 'dailyinout']);
Route::get('/monthlyinout',     [AttendanceController::class, 'monthlyinout']);
Route::get('/dailystatistic',   [AttendanceController::class, 'dailyGenerate']);
Route::get('/monthlystatistic', [AttendanceController::class, 'monthlyGenerate']);
Route::get('/monthlygrid',      [AttendanceController::class, 'monthlygrid']);
Route::get('/human',            [AttendanceController::class, 'human']);
Route::get('/filter',           [AttendanceController::class, 'attendanceFilter']);

