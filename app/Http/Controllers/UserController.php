<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all();
        return view('pages.users', compact('users'));
    }

    // Store user
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:6',
            'role'     => 'required|integer',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }

    // Edit user (fetch)
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.edit-user', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'role' => 'required|in:0,1',
    ]);

    $user = User::findOrFail($id);
    $user->update($request->only(['name', 'email', 'phone', 'role']));

    return redirect()->back()->with('success', 'User updated successfully!');
}


    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}
