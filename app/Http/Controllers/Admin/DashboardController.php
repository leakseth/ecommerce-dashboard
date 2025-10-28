<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
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

        // sale last months
        $months = collect();
        $salesData = collect();

        for($i = 5; $i >= 0; $i--){
            $month =now()->subMonth($i);
            $monthName = $month->format('M');
            $monthYear = $month->format('Y');

            $totalSales = Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total');

            $months->push($monthName);
            $salesData->push($totalSales);

        }
// Top sale product
        $topProducts = OrderItem::select('product_id')
            ->selectRaw('SUM(quantity) as total_sold')
            ->with('product:id,name')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get()
            ->map(function ($item){
                return [
                    'name' => $item->product->name ?? 'Deleted Product',
                    'sold' => $item->total_sold,
                ];
            });



        return view('pages.dashboard', [
            'months' => $months,
            'salesData' => $salesData,
            'topProducts' => $topProducts,
        ]
        ,
        compact('totalProducts', 'totalUsers', 'revenue', 'pendingOrders'));
    }
}
