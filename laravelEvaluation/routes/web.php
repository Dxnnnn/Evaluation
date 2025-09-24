<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/Login', [LoginController::class, 'index']);
Route::post('/Login', [LoginController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');