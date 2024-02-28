<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create', [CarController::class, 'create']);

Route::get('/list', [CarController::class, 'list']);

Route::post('/info', [CarController::class, 'info']);

Route::post('/reservation', [ReservationController::class, 'reservation']);

Route::post('/reservation/intro', [ReservationController::class, 'reservationIntro']);

Route::get('/show', [ReservationController::class, 'reservationShow']);

Route::post('/show', [ReservationController::class, 'info']);