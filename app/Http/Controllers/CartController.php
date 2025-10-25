<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

   public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->id;

        // Make sure quantity is integer
        $quantity = isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1;

        $cart[$id] = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'quantity' => $quantity
        ];

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => $request->name . ' added to cart',
            'cart_qty' => array_sum(array_column($cart, 'quantity'))
        ]);
    }


    public function update(Request $request)
    {
        $data = $request->all();
        $cart = session()->get('cart', []);

        if (isset($cart[$data['id']])) {
            $cart[$data['id']]['quantity'] = $data['quantity'];
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $data = $request->all();
        $cart = session()->get('cart', []);

        if (isset($cart[$data['id']])) {
            unset($cart[$data['id']]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function checkoutPage(){
        $cart = session()->get('cart', []);
        if(empty($cart)){
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        if(!Auth()->check()){
            return redirect()->route('login')->with('error', 'Please Login first.');
        }
        return view('checkout.index', compact('cart'));
    }

    public function checkoutConfirm(Request $request){
        $cart = session()->get('cart', []);
        if(empty($cart)){
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id'         => auth()->id(),
            'order_number'    => 'ORD-' . strtoupper(Str::random(8)),
            'total'           => $total,
            'status'          => 'pandding',
            'payment_method'  => $request->payment_method,
            'shipping_address'=> $request->address,
        ]);

        foreach($cart as $id => $item){
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }
        session()->forget('cart');
    }
}
