<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register/{id}', [AuthController::class, 'index'])->name('register/');
Route::post('/register/process/{id}', [AuthController::class, 'process'])->name('register-process/');
Route::get('/register/welcome', [AuthController::class, 'welcome_pin'])->name('register-welcome');
Route::post('/login/process/{id}', [AuthController::class, 'login_request'])->name('login-process/');

Route::post('/detailpage', [DetailController::class, 'index'])->name('detailpage');

Route::get('/cartpage/{id}', [CartController::class, 'index'])->name('cartpage/');

Route::get('/homepage/{id}', [HomeController::class, 'index'])->name('homepage/');
Route::post('/cart/tambah/{id}', [HomeController::class, 'do_tambah_cart'])->where("id", "[0-9]+")->name('cart/tambah/');
Route::delete('/cart/remove/{id}', [HomeController::class, 'removeFromCart'])->where("id", "[0-9]+")->name('cart/remove/');
Route::post('submit-order', [HomeController::class, 'submitOrder'])->name('submit-order');

Route::get('/historypage/{id}', [HistoryController::class, 'index'])->name('historypage/');

Route::post('/authcheck/{id}', [AuthController::class, 'login_request'])->name('authcheck/');
