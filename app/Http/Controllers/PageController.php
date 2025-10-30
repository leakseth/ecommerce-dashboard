<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        $products = Product::with('category')->paginate(4);
        return view('components.home', compact('products'));
    }

    public function shop(Request $request)
    {
        $categoryName = $request->query('category'); // e.g., ?category=Electronics
        $search = $request->query('search');         // search input
        $sort = $request->query('sort');             // sorting option

        $categories = Category::all(); // all categories

        // Start main query
        $productsQuery = Product::with('category');

        // Filter by category
        if ($categoryName) {
            $productsQuery->where('category_id', $categoryName);
        }

        // Filter by search term
        if ($search) {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('category', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        }


        // Apply sorting
        if ($sort == 'low_high') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($sort == 'high_low') {
            $productsQuery->orderBy('price', 'desc');
        } else {
            $productsQuery->latest(); // default: newest first
        }

        // Paginate results and keep query string
        $products = $productsQuery->paginate(8);

        return view('components.shop', compact('products', 'categories', 'categoryName', 'search', 'sort'));
    }


    public function about() {
        return view('components.about');
    }

    public function contact() {
        return view('components.contact');
    }

    public function productDetail($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories = Category::all(); // optional, if you want to show sidebar or menu
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(8)
            ->get();
        return view('components.product-detail', compact('product', 'categories', 'relatedProducts'));
    }
}
