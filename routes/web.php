<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);

Route::get('/dashboard', [AuthController::class, 'showDashboard']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::resource('products', ProductController::class);

Route::resource('users', UserController::class);

Route::resource('suppliers', SupplierController::class);