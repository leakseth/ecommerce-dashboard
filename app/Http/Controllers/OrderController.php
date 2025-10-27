<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderItems.product')
                       ->orderBy('created_at', 'desc')
                       ->paginate(15); // paginate for dashboard
        return view('pages.orders', compact('orders'));
    }

    public function show($id){
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);
        return view('pages.order_show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }



    public function history()
    {
        $orders = Order::with('orderItems.product')
                       ->where('user_id', Auth()->id())
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('orders.history', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::with('orderItems.product')
                      ->where('user_id', Auth::id())
                      ->findOrFail($id);

        return view('orders.detail', compact('order'));
    }
}
