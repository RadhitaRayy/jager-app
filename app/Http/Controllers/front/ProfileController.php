<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FrontendUser;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('frontend')->user();
        return view('frontend.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $user = Auth::guard('frontend')->user();
        $user->username = $request->input('username');
        $user->nomor_hp = $request->input('nomor_hp');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
