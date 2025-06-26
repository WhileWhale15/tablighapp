<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->roles->isEmpty()) {
            Auth::user()->assignRole('user'); // Assign default role
        }

        return $next($request);
    }
}
