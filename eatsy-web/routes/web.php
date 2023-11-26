<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemAdminController;
use App\Http\Controllers\ReportAdminController;
use App\Http\Controllers\TableAdminController;
use App\Http\Controllers\UserAdminController;
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

// For CMS routes
Route::get('/cms', [AuthAdminController::class, 'index'])->name('/');
Route::post('/cms/login_process', [AuthAdminController::class, 'login_process'])->name('login-process');
Route::get('/cms/logout', [AuthAdminController::class, 'logout'])->name('logout');

Route::get('/homecms', [UserAdminController::class, 'homepage'])->name('homepage');

Route::get('/cms/items', [ItemAdminController::class, 'index'])->name('items');
Route::get('/cms/items/create', [ItemAdminController::class, 'create'])->name('create_items');
Route::post('/cms/items/create_process', [ItemAdminController::class, 'create_process'])->name('create_items_process');
Route::get('/cms/items/{id}', [ItemAdminController::class, 'detail'])->name('items/');
Route::post('/cms/items_process/{id}', [ItemAdminController::class, 'item_process'])->name('items_process/');
Route::get('/cms/items/{id}/delete', [ItemAdminController::class, 'delete'])->name('items/delete/');

Route::get('/cms/tables', [TableAdminController::class, 'index'])->name('tables');
Route::get('/cms/tables/create', [TableAdminController::class, 'create'])->name('create_table');
Route::post('/cms/tables/create_process', [TableAdminController::class, 'create_process'])->name('create_table_process');
Route::get('/cms/tables/{id}', [TableAdminController::class, 'detail'])->name('tables/');
Route::post('/cms/tables_process/{id}', [TableAdminController::class, 'table_process'])->name('tables_process/');
Route::get('/cms/tables/{id}/delete', [TableAdminController::class, 'delete'])->name('tables/delete/');

Route::get('/cms/categories', [CategoryAdminController::class, 'index'])->name('categories');
Route::get('/cms/categories/create', [CategoryAdminController::class, 'create'])->name('create_category');
Route::post('/cms/categories/create_process', [CategoryAdminController::class, 'create_process'])->name('create_category_process');
Route::get('/cms/categories/{id}', [CategoryAdminController::class, 'detail'])->name('categories/');
Route::post('/cms/categories_process/{id}', [CategoryAdminController::class, 'category_process'])->name('categories_process/');
Route::get('/cms/categories/{id}/delete', [CategoryAdminController::class, 'delete'])->name('categories/delete/');

Route::get('/cms/users', [UserAdminController::class, 'index'])->name('users');
Route::get('/cms/users/create', [UserAdminController::class, 'create'])->name('create_user');
Route::post('/cms/users/create_process', [UserAdminController::class, 'create_process'])->name('create_user_process');
Route::get('/cms/users/{id}', [UserAdminController::class, 'detail'])->name('users/');
Route::post('/cms/users_process/{id}', [UserAdminController::class, 'user_process'])->name('users_process/');
Route::get('/cms/users/{id}/delete', [UserAdminController::class, 'delete'])->name('users/delete/');

Route::get('/cms/reports', [ReportAdminController::class, 'index'])->name('reports');
Route::get('/cms/reports/create', [ReportAdminController::class, 'create'])->name('create_reports');
Route::post('/cms/reports/create_process', [ReportAdminController::class, 'create_process'])->name('create_reports_process');
Route::get('/cms/reports/{id}', [ReportAdminController::class, 'detail'])->name('reports/');
Route::post('/cms/reports_process/{id}', [ReportAdminController::class, 'report_process'])->name('reports_process/');
Route::get('/cms/reports/{id}/delete', [ReportAdminController::class, 'delete'])->name('reports/delete/');