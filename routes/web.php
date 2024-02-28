<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('list');
});

Route::get('/create', function () {
    return Inertia::render('create');
});

Route::get('/show', function () {
    return Inertia::render('show');
});

Route::get('/reservation', function () {
    return Inertia::render('reservation');
});

Route::get('/show/{reservationId}', function ($reservationId) {
    return Inertia::render('showInfo', ['reservationId' => $reservationId]);
});