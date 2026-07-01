<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES (Only accessible when NOT logged in)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        // Role Management
        Route::resource('roles', RoleController::class);

        // Product Management
        Route::resource('products', ProductController::class);

        // User Management
        Route::resource('users', UserController::class);

    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN + SUPPLIER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,supplier')->group(function () {

        // Supplier Management
        Route::resource('suppliers', SupplierController::class);

    });

});