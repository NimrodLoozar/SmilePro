<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatisticsController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('appointments', AppointmentController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('patients', PatientController::class);
Route::resource('persons', PersonController::class);


Route::get('/banner', function () {
    return view('banner');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/conversations', [MessageController::class, 'createConversation'])->name('conversations.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::put('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
    Route::post('/messages/{conversation}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::delete('/conversations/{conversation}', [MessageController::class, 'destroy'])->name('conversations.destroy');
    Route::delete('/messages/deleteSelected', [MessageController::class, 'deleteSelected'])->name('messages.deleteSelected');
    Route::resource('schedules', ScheduleController::class);
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/messages', [MessageController::class, 'adminIndex'])->name('messages.admin.index');
    Route::get('/admindashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminDashboardController::class, 'showUsers'])->name('admin.users');

    // Employee
    Route::get('/admin/Employee', [EmployeeController::class, 'index'])->name('admin.Employee');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

    // ...other admin routes...
    Route::get('/messages/{conversation}', [MessageController::class, 'show'])->name('messages.show');
    Route::get('/messages/{conversation}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/messages/{conversation}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{conversation}', [MessageController::class, 'destroy'])->name('messages.destroy');
    Route::delete('/messages/{conversation}/deleteLastMessage', [MessageController::class, 'deleteLastMessage'])->name('messages.deleteLastMessage');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedule}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::patch('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__ . '/auth.php';
