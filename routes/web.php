<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('registration',[UserController::class,'register']);
Route::view('login','login');
Route::view('dashboard','dashboard');