<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::guard('frontend')->user();
        $cartItems = Cart::where('frontend_user_id', $user->id)->with('product')->get();
        return view('frontend.checkout', compact('cartItems', 'user'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);
    
        $user = Auth::guard('frontend')->user();
        $order = new Order();
        $order->frontend_user_id = $user->id;
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->total = $request->input('total');
        $order->status = 'pending'; // Menetapkan status default
        $order->save();
    
        $cartItems = Cart::where('frontend_user_id', $user->id)->get();
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->product->harga;
            $orderItem->save();
        }
    
        // Clear cart after placing order
        Cart::where('frontend_user_id', $user->id)->delete();
    
        return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    }

    public function success()
    {
        return view('frontend.success');
    }
}
