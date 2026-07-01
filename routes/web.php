<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

});

/*
|--------------------------------------------------------------------------
| DEFAULT ROUTE
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

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Setup
        |--------------------------------------------------------------------------
        */

        // Roles
        Route::resource('roles', RoleController::class);

        // Modules
        Route::resource('menus', MenuController::class);

        // Permissions
        Route::get('/permissions', [PermissionController::class, 'index'])
            ->name('permissions.index');

        Route::post('/permissions', [PermissionController::class, 'store'])
            ->name('permissions.store');

        // Users
        Route::resource('users', UserController::class);

        /*
        |--------------------------------------------------------------------------
        | Inventory
        |--------------------------------------------------------------------------
        */

        // Products
        Route::resource('products', ProductController::class);

    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN + SUPPLIER
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,supplier')->group(function () {

        Route::resource('suppliers', SupplierController::class);

    });

});