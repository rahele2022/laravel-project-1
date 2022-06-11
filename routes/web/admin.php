<?php

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'show']);
Route::get('/{user}/edit' , [\App\Http\Controllers\Admin\AdminController::class , 'edit']);
Route::put('/{id}/edit' , [\App\Http\Controllers\Admin\AdminController::class , 'update']);
Route::delete('/{id}' , [\App\Http\Controllers\Admin\AdminController::class , 'delete']);

//Route::get('/' , function (){
//    $user = User::find(1);
//    if (Gate::allows('edit-user')){
//        return 'admin panel';
//    }
//});
