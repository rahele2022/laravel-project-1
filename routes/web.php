<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserController2;


Route::resource('users', UserController::class);


Auth::routes(['verify' => true]);
