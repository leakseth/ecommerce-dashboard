<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('pages.product', compact('products', 'categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:in_stock,out_of_stock,low_stock',
            'description' => 'nullable|string',
        ]);
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null;
        }
        Product::create([
            'image' => $imagePath,
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'stock' => $request->stock,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index');
    }

    public function show($id){
        $product = Product::findOrFail($id);
        return view('pages.product', compact('product'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:in_stock,out_of_stock,low_stock',
            'description' => 'nullable|string',
        ]);
        $product = Product::findOrFail($id);
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }
        $product->name = $request->name;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->save();
        return redirect()->route('products.index');

    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        if($product->image){
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index');

    }
}
