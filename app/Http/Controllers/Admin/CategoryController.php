<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        $products = Product::with('category')->get();
        foreach ($categories as $category) {
            $category->total_products = $category->products()->count();
        }
        return view('pages.category', compact('categories', 'products'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Category::create([
            'name' => $request->name,
        ]);
        return redirect('/admin/categories')->with('success', 'Category created successfully!');
    }
    public function show($id){
        $category = Category::with('category')->findOrFail($id);
        return view('pages.category', compact('category'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return redirect('/admin/categories')->with('success', 'Category updated successfully!');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect('/admin/categories')->with('success', 'Category deleted successfully!');
    }
}
