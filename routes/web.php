<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dssController;
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

Auth::routes();

Route::get('/dashboard', [dssController::class,'dataInput'])->middleware(['auth'])->name('dashboard');

Route::post("dssData",[dssController::class,'addData']);

Route::get('/result', [dssController::class,'result'])->middleware(['auth'])->name('dashboard');

Route::get('/records', [dssController::class,'records'])->middleware(['auth'])->name('dashboard');
