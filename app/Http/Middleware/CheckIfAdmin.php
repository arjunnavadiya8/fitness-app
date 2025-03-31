<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redirect to home or show unauthorized if the user is not an admin
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
