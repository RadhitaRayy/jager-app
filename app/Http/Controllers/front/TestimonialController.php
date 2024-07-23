<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('frontend.testimoni.testimoni', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/testimonials/' . $imageName;
            $image->move(public_path('uploads/testimonials'), $imageName);
        }

        Testimonial::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imagePath,
            'rating' => $request->rating,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Testimoni berhasil ditambahkan');
    }
}
