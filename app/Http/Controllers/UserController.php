<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a list of all users.
     * Uses User::all() to fetch every user from the database.
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in the database.
     * Validates input, hashes the password, and sets the role.
     */
    public function store(Request $request)
    {
        // Validate all required fields
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,supplier,user',
        ]);

        // Create user with hashed password
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect('/users')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     * (Not used in this project, but included for completeness)
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing a user.
     * Passes the user data to pre-fill the form.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in the database.
     * Password is only updated if a new one is provided.
     */
    public function update(Request $request, User $user)
    {
        // Validate fields - email must be unique EXCEPT for this user's own email
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,supplier,user',
            'password' => 'nullable|string|min:6',
        ]);

        // Build the data array
        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        // Only update password if a new one was entered
        // This way, leaving the password field empty keeps the old password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect('/users')->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user from the database.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully.');
    }
}
