<?php
// use App\Http\Controllers\PatientController;

// Route::resource('datapatient', PatientController::class);
// use App\Http\Controllers\AppointmentController;

// Route::resource('dataappointment', AppointmentController::class);
// use App\Http\Controllers\ReportController;

// Route::resource('datareport', ReportController::class);



use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


