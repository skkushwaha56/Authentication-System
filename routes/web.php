<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::view('registration','registration');
Route::view('dashboard','dashboard');