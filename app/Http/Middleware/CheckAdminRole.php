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
            return redirect()->route('admin.list'); // role 0 users
        }

        return $next($request);
    }
}
