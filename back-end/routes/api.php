<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::resource('datapatient', PatientController::class);
use App\Http\Controllers\AppointmentController;

Route::resource('dataappointment', AppointmentController::class);
use App\Http\Controllers\ReportController;

Route::resource('datareport', ReportController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
