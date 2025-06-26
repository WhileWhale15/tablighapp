<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Removed debug dd() to allow normal middleware execution

        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
