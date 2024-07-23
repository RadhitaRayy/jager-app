<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Testimonial;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();

        return view('frontend.index', compact('products', 'testimonials'));
    }
}
