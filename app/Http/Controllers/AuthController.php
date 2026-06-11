<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showDashboard()
    {
        $menus = Menu::all();

        return view('dashboard', compact('menus'));
    }

    public function showRegister()
    {
        return view('register');
    }

    public function insertMenu()
    {
        Menu::create([
            'name' => 'Dashboard',
            'slug' => 'dashboard'
        ]);

        Menu::create([
            'name' => 'Products',
            'slug' => 'products'
        ]);

        Menu::create([
            'name' => 'Customers',
            'slug' => 'customers'
        ]);

        Menu::create([
            'name' => 'Suppliers',
            'slug' => 'suppliers'
        ]);

        Menu::create([
            'name' => 'Purchases',
            'slug' => 'purchases'
        ]);

        Menu::create([
            'name' => 'Purchase Items',
            'slug' => 'purchase-items'
        ]);

        Menu::create([
            'name' => 'Sales',
            'slug' => 'sales'
        ]);

        Menu::create([
            'name' => 'Sale Items',
            'slug' => 'sale-items'
        ]);

        Menu::create([
            'name' => 'Users',
            'slug' => 'users'
        ]);

        return "Menu inserted successfully";
    }
    public function login()
{
    return redirect('/dashboard');
}
}