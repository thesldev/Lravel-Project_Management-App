<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $authUserRole = Auth::user()->role;

        // Map role names to numeric values
        $roleMapping = [
            'supperAdmin' => 0,
            'admin' => 1,
            'employee' => 2,
        ];

        // Convert roles to their numeric values
        $allowedRoles = array_map(fn($role) => $roleMapping[$role] ?? null, $roles);

        // Check if the user's role is in the allowed roles
        if (in_array($authUserRole, $allowedRoles, true)) {
            // Allow access if the user's role matches the allowed roles
            return $next($request);
        }

        // Prevent redirection if the user is already on their correct dashboard
        if ($request->route()->getName() === 'supAdmin' && $authUserRole == 0) {
            return $next($request);
        }

        if ($request->route()->getName() === 'admin' && $authUserRole == 1) {
            return $next($request);
        }

        if ($request->route()->getName() === 'employeeDashboard' && $authUserRole == 2) {
            return $next($request);
        }

        // Redirect to the correct dashboard based on the user's role
        switch ($authUserRole) {
            case 0:
                return redirect()->route('supAdmin');
            case 1:
                return redirect()->route('admin');
            case 2:
                return redirect()->route('employeeDashboard');
            default:
                return redirect()->route('login');
        }
    }
}
