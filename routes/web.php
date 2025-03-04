<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::view('login','login');
Route::view('registration','registration');
Route::view('dashboard','dashboard');