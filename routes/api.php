<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\AdminController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    // Patients
    Route::get('/patients', [PatientController::class, 'index']);
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    // Practitioners
    Route::get('/practitioners', [PractitionerController::class, 'index']);
    Route::get('/practitioners/{id}', [PractitionerController::class, 'show']);
    Route::post('/practitioners', [PractitionerController::class, 'store']);
    Route::put('/practitioners/{id}', [PractitionerController::class, 'update']);
    Route::delete('/practitioners/{id}', [PractitionerController::class, 'destroy']);

    // Admins
    Route::get('/admins', [AdminController::class, 'index']);
    Route::get('/admins/{id}', [AdminController::class, 'show']);
    Route::post('/admins', [AdminController::class, 'store']);
    Route::put('/admins/{id}', [AdminController::class, 'update']);
    Route::delete('/admins/{id}', [AdminController::class, 'destroy']);
});