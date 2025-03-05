<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
        public function handle($request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role == $role) {
            return $next($request);
        }

        // Redirect or return error if user doesn't have the required role
        return redirect('/');
    }
}
