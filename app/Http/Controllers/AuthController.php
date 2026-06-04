<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showDashboard()
    {
        return view('dashboard');
    }

    public function showRegister()
    {
        return view('register');
    }
}