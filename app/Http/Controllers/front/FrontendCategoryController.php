<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class FrontendCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('frontend.category', compact('categories'));
    }
}
