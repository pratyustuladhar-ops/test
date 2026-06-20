<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [AuthController::class, 'showDashboard']);

Route::get('/register', [AuthController::class, 'showRegister']);


Route::get('/logout', [AuthController::class, 'logout']);

use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);