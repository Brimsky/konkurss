<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConcertsController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () { return view('welcome');});

Route::get('/api/v1/concerts', [ConcertsController::class, 'index']);
Route::get('/api/v1/concerts/{id}', [ConcertsController::class, 'show']);
Route::post('/api/v1/concerts/{concertid}/shows/{showid}/booking', [ReservationController::class, 'store']);
