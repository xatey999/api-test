<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store']);

//doctor routes:
// Route::resource('doctor', DoctorController::class)->middleware(['auth:sanctum']);
Route::post('/doctor/store',[DoctorController::class,'store'])->middleware(['auth:sanctum']);


//patient routes:
Route::post('/patient-form',[PatientController::class,'store'])->middleware(['auth:sanctum']);
require __DIR__.'/auth.php';

//for login