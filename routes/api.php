<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;


Route::controller(UsersController::class)->group(function(){
    Route::post('create', 'createUser');
    Route::post('edit', 'editUser');
    Route::post('delete', 'deleteUser');
    Route::get('get', 'getUser');
});
