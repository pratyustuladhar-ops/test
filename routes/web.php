<?php
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/dashboard', [AuthController::class, 'showDashboard']);
Route::get('/register', [AuthController::class, 'showRegister']);