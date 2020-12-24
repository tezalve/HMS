<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BedController;
use App\Http\Controllers\BedgroupController;
use App\Http\Controllers\ClinicalchartController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SubdepartmentController;
use App\Http\Controllers\UnitinfoController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\LabreportchartController;
use App\Http\Controllers\LabreportController;
use App\Http\Controllers\BarcodeprintController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicelistController;
use App\Http\Controllers\DiagnosticreportController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\DiagnosticreportviewController;

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

// Route::get('/', [DoctorController::Class, 'index']);

Route::resource('doctors',                          DoctorController::Class);
Route::resource('patients',                         PatientController::Class);
Route::resource('beds',                             BedController::Class);
Route::resource('departments',                      DepartmentController::Class);
Route::resource('clinicalcharts',                   ClinicalchartController::Class);
Route::resource('subdepartments',                   SubdepartmentController::Class);
Route::resource('unitinfos',                        UnitinfoController::Class);
Route::resource('investigations',                   InvestigationController::Class);
Route::resource('labreportcharts',                  LabreportchartController::Class);
Route::resource('labreports',                       LabreportController::Class);
Route::resource('invoicelists',                     InvoicelistController::Class);
Route::resource('invoices',                         InvoiceController::Class);
Route::resource('barcodeprints',                    BarcodeprintController::Class);
Route::resource('diagnosticreports',                DiagnosticreportController::Class);
Route::resource('diagnosticreportviews',            DiagnosticreportviewController::Class);
Route::resource('datas',                            DataController::Class);


Route::post('investigtionnew',                      [AutocompleteController::Class, 'investigtionnew']);
Route::post('isempty',                              [AutocompleteController::Class, 'isempty']);
Route::post('doctord',                              [AutocompleteController::Class, 'doctord']);

Route::post('subdeplist',                           [DataController::Class, 'subdeplist']);


Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('main');
})->name('dashboard');
