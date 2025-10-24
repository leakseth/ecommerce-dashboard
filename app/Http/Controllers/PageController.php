<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        $products = Product::paginate(4);
        return view('components.home', compact('products'));
    }

    public function shop(Request $request) {
        $categoryName = $request->query('category'); // e.g., ?category=Electronics
        $categories = Category::all(); // List of all categories
        $search = $request->query('search'); // get search input
        // Start query builder
        $productsQuery = Product::query();

        // Filter by category if selected
        if ($categoryName) {
            $productsQuery->where('category', $categoryName);
        }

        // Filter by search term
        if ($search) {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        // Paginate results & keep query string
        $products = $productsQuery->paginate(8);

        return view('components.shop', compact('products', 'categories', 'categoryName', 'search'));
    }

    public function about() {
        return view('components.about');
    }

    public function contact() {
        return view('components.contact');
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // optional, if you want to show sidebar or menu
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();
        return view('components.product-detail', compact('product', 'categories', 'relatedProducts'));
    }


}
