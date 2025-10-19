<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $revenue = Product::sum('price') ?? 0;
        $pendingOrders = 0; // Placeholder for future implementation
        return view('pages.dashboard', compact('totalProducts', 'totalUsers', 'revenue', 'pendingOrders'));
    }
}
