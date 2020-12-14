<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;

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

Route::resource('doctors', DoctorController::Class);
Route::resource('patients', PatientController::Class);

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('welcome');
})->name('dashboard');
