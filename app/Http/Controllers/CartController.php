<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order; // Make sure you have an Order model

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('frontends.checkout', compact('cart'));
    }

    // 2️⃣ Add Product to Cart (Session Only)
    public function add(Request $request)
    {
        $product = [
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'quantity' => 1,
        ];

        $cart = Session::get('cart', []);
        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity'] += 1;
        } else {
            $cart[$product['id']] = $product;
        }

        Session::put('cart', $cart);

        return response()->json(['message' => 'Product added!', 'cartCount' => count($cart)]);
    }

    // 3️⃣ Update Quantity
    public function update(Request $request)
    {
        $cart = Session::get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            if ($request->action === 'increase') $cart[$id]['quantity'] += 1;
            if ($request->action === 'decrease' && $cart[$id]['quantity'] > 1) $cart[$id]['quantity'] -= 1;
        }

        Session::put('cart', $cart);

        return response()->json(['cart' => $cart]);
    }

    // 4️⃣ Remove Item
    public function remove(Request $request)
    {
        $cart = Session::get('cart', []);
        unset($cart[$request->id]);
        Session::put('cart', $cart);

        return response()->json(['cart' => $cart]);
    }

    // 5️⃣ Save Cart to Database (Checkout)
    public function save(Request $request)
    {
        $cart = Session::get('cart', []);

        foreach ($cart as $item) {
            Order::create([
                'user_id' => auth()->id(), // if using login
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        Session::forget('cart'); // Clear session after saving

        return redirect()->route('cart.index')->with('success', 'Cart saved successfully!');
    }
}