<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/Login', [LoginController::class, 'index']);
Route::post('/Login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/role-selection', [RoleController::class, 'index'])->name('role.selection');
    Route::post('/role-selection', [RoleController::class, 'selectRole'])->name('role.select');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});