<?php

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

Route::get('/', [\App\Http\Controllers\Customer\CustomerController::class, 'index']);
Route::get('/create' , [\App\Http\Controllers\Customer\CustomerController::class , 'create']);
Route::post('/create' , [\App\Http\Controllers\Customer\CustomerController::class , 'store']);
Route::get('/{customer}/edit' , [\App\Http\Controllers\Customer\CustomerController::class , 'edit']);
Route::put('/{id}/edit' , [\App\Http\Controllers\Customer\CustomerController::class , 'update']);
Route::delete('/{id}' , [\App\Http\Controllers\Customer\CustomerController::class , 'delete']);


Auth::routes();

