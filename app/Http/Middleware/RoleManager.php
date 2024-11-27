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
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $authUserRole = Auth::user()->role;

        switch ($role) {
            case 'supperAdmin':
                if ($authUserRole == 0) {
                    return $next($request);
                }
                break;
            case 'admin':
                if ($authUserRole == 1) {
                    return $next($request);
                }
                break;
            case 'employee':
                if ($authUserRole == 2) {
                    return $next($request);
                }
                break;
        }

        // If the user is already on their correct dashboard, prevent redirection
        if ($request->route()->getName() === 'supAdmin' && $authUserRole == 0) {
            return $next($request);
        }

        if ($request->route()->getName() === 'admin' && $authUserRole == 1) {
            return $next($request);
        }

        if ($request->route()->getName() === 'employeeDashboard' && $authUserRole == 2) {
            return $next($request);
        }

        // Redirect to the correct dashboard if not already on it
        switch ($authUserRole) {
            case 0:
                return redirect()->route('supAdmin');
            case 1:
                return redirect()->route('admin');
            case 2:
                return redirect()->route('employeeDashboard');
        }

        return redirect()->route('login');
    }

}
