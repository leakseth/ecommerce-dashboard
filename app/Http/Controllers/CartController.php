<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
    public function count()
{
    $cart = session()->get('cart', []);
    $count = count($cart); // ✅ count distinct products
    return response()->json(['count' => $count]);
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
}
