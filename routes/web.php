<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;


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

Route::get('/',[PaymentController::class,'welcome'])->name('welcome');
Route::get('/success',[PaymentController::class,'success']);
Route::post('/payment',[PaymentController::class,'payment']);
Route::post('/pay',[PaymentController::class,'pay']);
Route::get('/error',[PaymentController::class,'error']);
