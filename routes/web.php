<?php

use App\Http\Controllers\FarmerController;
use App\Http\Controllers\LabourController;
use App\Http\Controllers\PickingController;
use App\Http\Controllers\PickingnumberController;
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

Route::resource('pickings', PickingController::class);

Route::resource('farmers', FarmerController::class);

Route::resource('labours', LabourController::class);

Route::resource('pickingnumbers', PickingnumberController::class);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
