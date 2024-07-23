<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class FrontendProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Pencarian berdasarkan nama produk
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        
        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        $categories = Category::all();
        return view('frontend.product', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $recommendedProducts = Product::inRandomOrder()->take(3)->get();
        return view('frontend.detailproduct', compact('product', 'recommendedProducts'));
    }

    public function productByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $categories = Category::all();
        $products = Product::where('category_id', $categoryId)->get();
        return view('frontend.by_category', compact('category', 'products', 'categories'));
    }
}