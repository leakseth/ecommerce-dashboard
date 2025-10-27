<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $revenue = Order::sum('total') ?? 0;
        $pendingOrders = Order::where('status', 'pending')->count(); // Placeholder for future implementation
        return view('pages.dashboard', compact('totalProducts', 'totalUsers', 'revenue', 'pendingOrders'));
    }
}
