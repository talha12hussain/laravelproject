<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = null;

        // Check if the role is 'admin' and get the authenticated user for the 'admin' role
        if ($role === 'admin') {
            $user = Auth::guard('web')->user();
            if($user){
                return $next($request);
            }else{
                return redirect('/');
            }
        }

        // Check if the role is 'agent' and get the authenticated user for the 'agent' role
        elseif ($role === 'agent') {
            $user = Auth::guard('agent')->user();
            if($user){
                return $next($request);
            }else{
                return redirect('/');
            }
        }

        // If the user is not authenticated or their role doesn't match, redirect to home page
        if (!$user || $user->role !== $role) {
            return redirect('/'); // Redirect to the home or login page
        }

        // Allow the request to proceed
        return $next($request);
    }
}
