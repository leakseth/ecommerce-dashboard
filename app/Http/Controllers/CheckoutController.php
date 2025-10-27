<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutPage()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function checkoutConfirm(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id'          => Auth::id(),
            'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(5)),
            'total'            => $total,
            'status'           => 'pending',
            'payment_method'   => $request->payment_method ?? 'COD',
            'shipping_address' => $request->address,
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.history')->with('success', 'Your order has been placed successfully!');
    }
}
