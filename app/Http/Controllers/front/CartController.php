<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $user_id = Auth::guard('frontend')->id();
    
        $cartItem = Cart::where('frontend_user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->first();
    
        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Create new cart item
            Cart::create([
                'frontend_user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);
        }
    
        return response()->json(['success' => true, 'message' => 'Item added to cart.']);
    }    

    public function showCart()
    {
        $user_id = Auth::guard('frontend')->id(); // atau null jika tidak menggunakan autentikasi
        $cartItems = Cart::where('frontend_user_id', $user_id)->with('product')->get();
    
        // Filter out cart items with null products
        $cartItems = $cartItems->filter(function($item) {
            return $item->product !== null;
        });
    
        return view('frontend.cart', compact('cartItems'));
    }

    public function updateCart(Request $request)
    {
        $cartItem = Cart::find($request->id);
        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function deleteCartItem(Request $request)
    {
        $cartItem = Cart::find($request->id);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }

}
