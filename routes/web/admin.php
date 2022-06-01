<?php

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/{customer}/edit' , [\App\Http\Controllers\Customer\CustomerController::class , 'edit']);
Route::put('/{id}/edit' , [\App\Http\Controllers\Customer\CustomerController::class , 'update']);
Route::delete('/{id}' , [\App\Http\Controllers\Customer\CustomerController::class , 'delete']);

//Route::get('/' , function (){
//    $user = User::find(1);
//    if (Gate::allows('edit-user')){
//        return 'admin panel';
//    }
//});
