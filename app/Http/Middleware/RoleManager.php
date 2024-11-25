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
        if(!Auth::check()){
            return redirect('login');
        }

        $authUserRole = Auth::user()->role;

        switch($role){
            case 'supperAdmin':
                if($authUserRole == 0){
                    return $next($request);
                }
                break;
            case 'admin':
                if($authUserRole == 0){
                    return $next($request);
                }
                break;
            case 'employee':
                if($authUserRole == 2){
                    return $next($request);
                }
                break;
        }

        switch($authUserRole){
            case 0:
                return redirect()->route('supAdminDashboard');
            case 1:
                return redirect()->route('adminDashboard');
            case 2:
                return redirect()->route('dashboard');
        }

        return redirect()->route('login');
    }
}
