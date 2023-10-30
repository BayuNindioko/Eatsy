<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReservationController;

Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{id}', [ItemController::class, 'detail']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/tables/{id}/reservations/register', [ReservationController::class, 'registration']);
Route::post('/tables/{id}/reservations', [ReservationController::class, 'generate']);
Route::get('/tables/reservations/{id}/login', [ReservationController::class, 'check_login']);
Route::post('/tables/reservations/{id}', [ReservationController::class, 'checkout']);
