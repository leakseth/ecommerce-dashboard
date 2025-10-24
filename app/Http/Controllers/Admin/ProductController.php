<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);
        $stock = $validated['stock'];
        $status = $stock > 10 ? 'in_stock' : ($stock > 0 ? 'low_stock' : 'out_of_stock');
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null;
        }
        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'status' => $status, // auto set here based on stock
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index');
    }

    public function show($id){
        $product = Product::findOrFail($id);
        // Related products with the same category
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        return view('pages.product', compact('product', 'relatedProducts'));
    }

    public function update(Request $request, $id){
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string', 
        ]);
        $product = Product::findOrFail($id);
        $stock = $validated['stock'];
        $status = $stock > 10 ? 'in_stock' : ($stock > 0 ? 'low_stock' : 'out_of_stock');
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }
        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'status' => $status,
            'image' => $product->image,
        ]);
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
