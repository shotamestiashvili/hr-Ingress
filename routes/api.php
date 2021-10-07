<?php

use App\Http\Controllers\Api\InoutController;
use App\Http\Controllers\Api\PersonnelController;
use App\Http\Controllers\Api\AbsenceController;
use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\FamilyController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\QualificationController;
use App\Http\Controllers\Api\SalarydateController;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\WorktypeController;
use App\Http\Controllers\Api\ImportController;
use App\Http\Controllers\Api\ExportController;
use App\Http\Controllers\Api\FileUploadController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\MsoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Import /Export files start here //
Route::POST('/upload',   [FileUploadController::class, 'store']);


Route::POST('/import/personnel',   [ImportController::class, 'importPersonnel']);
Route::POST('/import/worktype',    [ImportController::class, 'importWorktype']);
Route::POST('/import/position',    [ImportController::class, 'importPosition']);
Route::POST('/import/schedule',    [ImportController::class, 'importSchedule']);
Route::GET('/export/personnel',    [ExportController::class, 'exportPersonnel']);
Route::GET('/export/worktype',     [ExportController::class, 'exportWorktype']);
Route::GET('/export/position',     [ExportController::class, 'exportPosition']);
//Import /Export files end here //


Route::GET('/inout/index',                    [InoutController::class, 'index']);
Route::GET('/inout/refresh',                  [InoutController::class, 'refresh']);
Route::GET('/inout/generate',                 [InoutController::class, 'generate']);
Route::GET('/inout/montlyInout',              [InoutController::class, 'montlyInout']);
Route::GET('/inout/newUserInout',             [InoutController::class, 'newUserInout']);

Route::GET('/mso/personnel/index',               [MsoController::class, 'index']);
Route::POST('/mso/personnel/store',              [MsoController::class, 'store']);


Route::resource('personnel/personnellist',   PersonnelController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('personnel/schedules',    ScheduleController::class)
    ->only(['index', 'store', 'destroy',]);


Route::resource('references/absences',      AbsenceController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('/references/contracts',    ContractController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/departments',   DepartmentController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/educations',    EducationController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/family',        FamilyController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/holidays',   HolidayController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/positions',   PositionController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/qualifications',   QualificationController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/salarydates',   SalarydateController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/trainings',   TrainingController::class)
    ->only(['index', 'store', 'destroy',]);

Route::resource('references/worktypes',   WorktypeController::class)
    ->only(['index', 'store', 'destroy',]);
//References routes end here//
