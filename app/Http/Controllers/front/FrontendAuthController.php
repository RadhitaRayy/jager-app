<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\FrontendUser;

class FrontendAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:frontend_users',
            'nomor_hp' => 'required',
            'username' => 'required|unique:frontend_users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = FrontendUser::create([
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    public function login(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        // Cek apakah input adalah email atau username
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Autentikasi pengguna menggunakan guard frontend
        if (Auth::guard('frontend')->attempt([$fieldType => $login, 'password' => $password])) {
            // Autentikasi sukses
            return redirect()->intended('/#!/');
        } else {
            // Autentikasi gagal
            return back()->withErrors(['login' => 'Login gagal, silakan cek kembali email/username dan password Anda.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('frontend')->logout();
        return redirect('/');
    }
}
