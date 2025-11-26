<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluationController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/Login', [LoginController::class, 'index']);
Route::post('/Login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {

    // Role selection
    Route::get('/role-selection', [RoleController::class, 'index'])->name('role.selection');
    Route::post('/role-selection', [RoleController::class, 'selectRole'])->name('role.select');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Employee management
    Route::get('/employee-list', [EmployeeController::class, 'index'])->name('employee.list');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    // Evaluation Form
    Route::get('/evaluation-form', [EvaluationController::class, 'index'])->name('evaluation.form');
    Route::post('/evaluation-form', [EvaluationController::class, 'submit'])->name('evaluation.submit');
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
