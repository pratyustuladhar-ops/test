<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * RoleMiddleware - Controls which pages each user role can access.
 *
 * HOW IT WORKS:
 * - This middleware receives one or more role names as parameters
 * - It checks if the logged-in user's role matches any of the allowed roles
 * - If YES → allow access to the page
 * - If NO → redirect to dashboard with an error message
 *
 * USAGE IN ROUTES:
 * - middleware('role:admin')           → only admin can access
 * - middleware('role:admin,supplier')  → admin AND supplier can access
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  One or more role names (e.g., 'admin', 'supplier')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Check if the user is logged in and their role is in the allowed list
        // auth()->user()->role gets the role from the users table
        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            // User doesn't have permission → redirect with error message
            return redirect('/dashboard')->with('error', 'You do not have permission to access this page.');
        }

        // User has the right role → let them continue to the page
        return $next($request);
    }
}
