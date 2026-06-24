<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Show the login form.
     * This page is only visible to guests (not logged in users).
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Handle the login form submission.
     * Steps:
     * 1. Validate that email and password are provided
     * 2. Try to authenticate using Auth::attempt()
     * 3. If successful → regenerate session → redirect to dashboard
     * 4. If failed → redirect back with error message
     */
    public function login(Request $request)
    {
        // Step 1: Validate the input fields
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Step 2: Try to log the user in
        // Auth::attempt() checks the email and password against the database
        // It automatically compares the hashed password
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Step 3: Login successful!
            // Regenerate the session ID to prevent session fixation attacks
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        // Step 4: Login failed - redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form.
     * This page is only visible to guests (not logged in users).
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Handle the registration form submission.
     * Steps:
     * 1. Validate all input fields
     * 2. Create a new user with hashed password
     * 3. Auto-login the new user
     * 4. Redirect to dashboard
     */
    public function register(Request $request)
    {
        // Step 1: Validate all fields
        // 'confirmed' rule means there must be a password_confirmation field that matches
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Step 2: Create the user
        // Hash::make() encrypts the password so it's stored securely
        // New users always get the 'user' role by default
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        // Step 3: Auto-login the newly registered user
        Auth::login($user);

        // Step 4: Redirect to dashboard
        return redirect('/dashboard');
    }

    /**
     * Show the dashboard with real data from the database.
     * Displays:
     * - Total Products, Suppliers, Users (counts from DB)
     * - Registration Analytics: users registered today, this week, this month
     */
    public function showDashboard()
    {
        // Count totals from the database using Eloquent
        $totalProducts  = Product::count();
        $totalSuppliers = Supplier::count();
        $totalUsers     = User::count();

        // Registration Analytics using Carbon for date comparisons
        // Carbon::today() = start of today (00:00:00)
        // Carbon::now()->startOfWeek() = start of this week (Monday 00:00:00)
        // Carbon::now()->startOfMonth() = start of this month (1st day 00:00:00)
        $usersToday     = User::whereDate('created_at', Carbon::today())->count();
        $usersThisWeek  = User::where('created_at', '>=', Carbon::now()->startOfWeek())->count();
        $usersThisMonth = User::where('created_at', '>=', Carbon::now()->startOfMonth())->count();

        // Pass all data to the dashboard view
        return view('dashboard', compact(
            'totalProducts',
            'totalSuppliers',
            'totalUsers',
            'usersToday',
            'usersThisWeek',
            'usersThisMonth'
        ));
    }

    /**
     * Log the user out.
     * Steps:
     * 1. Auth::logout() - removes the user from the session
     * 2. Invalidate the session - destroys all session data
     * 3. Regenerate the CSRF token - for security
     * 4. Redirect to login page
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}