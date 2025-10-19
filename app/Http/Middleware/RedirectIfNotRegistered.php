<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotRegistered
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Redirect to dashboard with a flag to show register modal
            return redirect('/dashboard')->with('showRegisterModal', true);
        }

        return $next($request);
    }
}
