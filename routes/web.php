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

Route::get('/', [\App\Http\HomeController::class, 'index']);
Route::get('/create' , [\App\Http\HomeController::class , 'create']);
Route::post('/create' , [\App\Http\HomeController::class , 'store']);
Route::get('/{customer}/edit' , [\App\Http\HomeController::class , 'edit']);
Route::put('/{id}/edit' , [\App\Http\HomeController::class , 'update']);
Route::delete('/{id}' , [\App\Http\HomeController::class , 'delete'])->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
