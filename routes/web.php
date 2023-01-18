<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dssController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\postDataController;
use App\Http\Controllers\viewData;
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

Route::get('/', function () {
    return view('landingPage');
});



Route::get('/sendMail', [MailController::class, 'sendMail']);

Route::get('/mailSent', function () {
    return view('landingPage');
});

Auth::routes();
Auth::routes(['register' => false]);

Route::get('/dashboard', [viewData::class,'whatToView'])->middleware(['auth'])->name('dashboard');

Route::get('/monitoringPage',  [viewData::class,'viewMonitoringPage'])->middleware(['auth'])->name('dashboard'); 

Route::post("dssData",[postDataController::class,'addData']);

Route::get('/decision', [dssController::class,'result'])->middleware(['auth'])->name('dashboard');

Route::get('/result', [viewData::class,'viewResults'])->middleware(['auth'])->name('dashboard');

Route::get('/records', [dssController::class,'records'])->middleware(['auth'])->name('dashboard');

//Route::get('/predict', [dssPredict::class,'predict'])->middleware(['auth'])->name('dashboard');
