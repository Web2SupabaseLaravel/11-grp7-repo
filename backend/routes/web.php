<?php

use Illuminate\Support\Facades\Route;





use App\Http\Controllers\AdminController;

use App\Http\Controllers\NotificationsController;

Route::resource('dataNotifications', NotificationsController::class); 


Route::resource('dataAdmin', AdminController::class); 


#use App\Http\Controllers\UserSofyanController;
#Route::resource('datauser', UserSofyanController::class);

Route::get('/', function () {
    return view('app'); 
});






Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
