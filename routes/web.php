<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/Appointment', function () {
    return view('Appointment');
});

Route::get('/banner', function () {
    return view('banner');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/conversations/{conversation}/reply', [MessageController::class, 'reply'])->name('messages.reply');
    // Beschikbaarheid index
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    
    // Beschikbaarheid create
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    
    // Show specific schedule
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedules.show');
});


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::resource('schedules', ScheduleController::class)->middleware('auth');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::put('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
});

require __DIR__ . '/auth.php';
