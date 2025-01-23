
<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatisticsController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RegistrationLinkController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('appointments', AppointmentController::class);
Route::get('appointments/{appointment}/change-date', [AppointmentController::class, 'editDate'])->name('appointments.change-date');
Route::put('appointments/{appointment}/change-date', [AppointmentController::class, 'changeDate'])->name('appointments.update-date');

Route::resource('employees', EmployeeController::class);
// Route::resource('patient', PatiëntController::class);
Route::resource('persons', PersonController::class);


Route::get('/banner', function () {
    return view('banner');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');
    Route::get('/patient/create', [PatientController::class, 'create'])->name('patient.create');
    Route::get('/patient/{patient}', [PatientController::class, 'show'])->name('patient.show');
    Route::post('/patient', [PatientController::class, 'store'])->name('patient.store');
    Route::get('/patient/{patient}/edit', [PatientController::class, 'edit'])->name('patient.edit');
    Route::post('/patient/update', [PatientController::class, 'update'])->name('patient.update');
    Route::delete('/patient/{patient}', [PatientController::class, 'destroy'])->name('patient.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/conversations', [MessageController::class, 'createConversation'])->name('conversations.create');

    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::put('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
    Route::post('/messages/{conversation}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/deleteSelected', [MessageController::class, 'deleteSelected'])->name('messages.deleteSelected');

    Route::delete('/conversations/{conversation}', [MessageController::class, 'destroy'])->name('conversations.destroy');

    Route::resource('schedules', ScheduleController::class);

    Route::resource('invoice', InvoiceController::class);
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/{invoice}/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::get('/invoice/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::post('/invoice', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::put('/invoice/{invoice}', [InvoiceController::class, 'update'])->name('invoice.update');
    Route::delete('/invoice/{invoice}', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
    Route::get('/invoice/latest-number', [InvoiceController::class, 'latestNumber'])->name('invoice.latestNumber');

});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/messages', [MessageController::class, 'adminIndex'])->name('messages.admin.index');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminDashboardController::class, 'showUsers'])->name('admin.users');

    // Employee
    Route::get('/admin/Employee', [EmployeeController::class, 'index'])->name('admin.Employee');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::middleware(['auth'])->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::put('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
    });

    Route::get('/admin/employees/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/admin/employees', [EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::post('/admin/employees/generate-link', [RegistrationLinkController::class, 'generate'])->name('admin.employees.generate-link');
    Route::get('/register/{token}', [RegistrationLinkController::class, 'registerForm'])->name('register.form');
    Route::post('/register/{token}', [RegistrationLinkController::class, 'register'])->name('register');

    Route::controller(TreatmentController::class)->group(function () {
        Route::get('/treatments', 'index'); // List treatments with filters
        Route::post('/treatments', 'store'); // Create a new treatment
        Route::get('/treatments/{treatment}', 'show'); // Show a specific treatment
        Route::put('/treatments/{treatment}', 'update'); // Update a treatment
        Route::delete('/treatments/{treatment}', 'destroy'); // Delete a treatment
        Route::get('/treatments/upcoming', 'upcoming'); // Get all upcoming treatments
        Route::patch('/treatments/{treatment}/toggle-active', 'toggleActive'); // Toggle the active status
        Route::get('/treatments/{treatment}/formatted-cost', 'getFormattedCost'); // Get formatted cost
    });

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
