<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('registration',[UserController::class,'register']);
Route::post('registration/store',[UserController::class,'store']);
Route::get('registration/edit',[UserController::class,'edit']);
Route::put('registration/update',[UserController::class,'update']);
Route::delete('registration/delete',[UserController::class,'destroy']);

Route::view('login','login');
Route::view('dashboard','dashboard');