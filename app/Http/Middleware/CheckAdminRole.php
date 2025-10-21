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

        // ប្រៀបធៀប role តាមដែលបានកំណត់
        if (Auth::user()->role != $role) {
            // ប្រសិនបើមិនស្មើ role ត្រូវ redirect ទៅ home
            return redirect()->route('store');
        }

        return $next($request);
    }
}
