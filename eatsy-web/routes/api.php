<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReservationController;

Route::get('/items', [ItemController::class, 'index']);

Route::get('/tables/{id}/reservations/register', [ReservationController::class, 'registration']);
Route::post('/tables/{id}/reservations', [ReservationController::class, 'login']);
Route::post('/tables/reservations/{id}/login', [ReservationController::class, 'check_login']);
