<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserSofyanController;
use App\Http\Controllers\SystemController;
Route::resource('datauser', UserSofyanController::class);
Route::resource('dataSystem', SystemController::class);


use App\Models\UserSofyan;

Route::get('/datauser', function () {
    $users = UserSofyan::select('user_id', 'name', 'email', 'role', 'status')->get();
    return response()->json($users);
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/dataAdmin', function () {
    return response()->json([
        'users' => 120,
        'active' => 85,
        'newUsers' => 15,      
        'totalAdmins' => 3,   
    ]);
});



Route::post('/settings', function (Request $request) {
  
    return response()->json(['message' => 'Settings saved']);
});


