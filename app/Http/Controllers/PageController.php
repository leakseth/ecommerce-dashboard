<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        $products = Product::paginate(12);
        return view('components.home', compact('products'));
    }

    public function shop(Request $request) {
        $categoryName = $request->query('category'); // e.g., ?category=Electronics
        $categories = Category::all(); // List of all categories

        // Start query builder
        $productsQuery = Product::query();

        // Filter by category if selected
        if ($categoryName) {
            $productsQuery->where('category', $categoryName);
        }

        // Paginate results & keep query string
        $products = $productsQuery->paginate(12)->withQueryString();

        return view('components.shop', compact('products', 'categories', 'categoryName'));
    }

    public function about() {
        return view('components.about');
    }

    public function contact() {
        return view('components.contact');
    }

}
