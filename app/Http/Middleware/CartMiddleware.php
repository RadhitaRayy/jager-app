<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Symfony\Component\HttpFoundation\Response;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('frontend')->check()) {
            $user_id = Auth::guard('frontend')->id();
            $cartItems = Cart::where('frontend_user_id', $user_id)->with('product')->get();
        } else {
            $cartItems = collect();
        }

        view()->share('cartItems', $cartItems);

        return $next($request);
    }
}
