<?php

use App\Http\Controllers\UserController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;



Route::get('registration', [UserController::class, 'register']);
Route::post('registration', [UserController::class, 'store'])->name('registration');
Route::get('registration/edit/{id}', [UserController::class, 'edit'])->name('registration.edit');
Route::put('registration/update/{id}', [UserController::class, 'update'])->name('registration.update');
Route::delete('registration/delete/{id}', [UserController::class, 'destroy'])->name('registration.delete');

Route::post('login', [UserController::class,'login'])->name('login');
Route::view('dashboard', 'dashboard');
