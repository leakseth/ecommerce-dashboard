<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SerttingController extends Controller
{
    public function securityForm()
    {
        return view('settings.security'); // Blade file
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed', // uses confirm rule
        ]);

        $user = Auth::user();

        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
