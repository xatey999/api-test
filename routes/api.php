<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ScheduleController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store']);

//doctor routes:
// Route::resource('doctor', DoctorController::class)->middleware(['auth:sanctum']);
Route::post('/doctor/store',[DoctorController::class,'store'])->middleware(['auth:sanctum']);


//patient routes:
Route::post('/patient-form',[PatientController::class,'store'])->middleware(['auth:sanctum']);
Route::get('doctor-list',[PatientController::class,'index'])->middleware(['auth:sanctum']);

//schedules routes:
Route::post('/schedules',[ScheduleController::class,'store'])->middleware(['auth:sanctum']);
Route::get('/schedules', [ScheduleController::class,'show'])->middleware(['auth:sanctum']);
Route::delete('/schedules/{id}', [ScheduleController::class,'destroy'])->middleware(['auth:sanctum']);
Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->middleware('auth:sanctum');

require __DIR__.'/auth.php';

//for login