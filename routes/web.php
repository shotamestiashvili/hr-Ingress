<?php

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
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/vue', function () {
    return view('vue');
});

// Route::get('/test', AttendanceController);

Route::get('/fetch',   [AttendanceController::class, 'dailyAtt']);

Route::get('/currency',   [AttendanceController::class, 'currency']);
Route::get('/carbon',    [AttendanceController::class, 'carbon']);

