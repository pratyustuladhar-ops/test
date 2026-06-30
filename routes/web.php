<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES (only accessible when NOT logged in)
|--------------------------------------------------------------------------
| These routes are for visitors who haven't logged in yet.
| If a logged-in user tries to access /login or /register,
| they will be redirected to the dashboard.
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Redirect root URL to login page
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (require login)
|--------------------------------------------------------------------------
| These routes are protected by the 'auth' middleware.
| If a guest tries to access these, they will be redirected to /login.
*/

Route::middleware('auth')->group(function () {

    // Dashboard - accessible by ALL logged-in users (admin, supplier, user)
    Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |----------------------------------------------------------------------
    | ADMIN-ONLY ROUTES
    |----------------------------------------------------------------------
    | Only users with role 'admin' can access these pages.
    | Products, Users management
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('users', UserController::class);
    });

    /*
    |----------------------------------------------------------------------
    | ADMIN + SUPPLIER ROUTES
    |----------------------------------------------------------------------
    | Users with role 'admin' OR 'supplier' can access these pages.
    */
    Route::middleware('role:admin,supplier')->group(function () {
        Route::resource('suppliers', SupplierController::class);
    });
});