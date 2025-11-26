<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentEvaluationController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [LoginController::class, 'index'])->name('login'); // required by auth middleware
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
// Backwards compatibility for existing capitalized path
Route::get('/Login', [LoginController::class, 'index']);
Route::post('/Login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/role-selection', [RoleController::class, 'index'])->name('role.selection');
    Route::post('/role-selection', [RoleController::class, 'selectRole'])->name('role.select');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/student-evaluation', [StudentEvaluationController::class, 'index'])->name('student.evaluation');
    Route::post('/student-evaluation', [StudentEvaluationController::class, 'store'])->name('student.evaluation.store');
    Route::get('/employee-list', [EmployeeController::class, 'index'])->name('employee.list');
    Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});



