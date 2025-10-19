<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form');
        }

        if (Auth::user()->role != $role) {
            if ($role == 1) {
                // Non-admin tried to access admin page
                return redirect()->route('user.dashboard'); // ✅ redirect to user store page (GET)
            } else {
                return redirect()->route('dashboard'); // ✅ redirect to admin dashboard (GET)
            }
        }

        return $next($request);
    }
}
