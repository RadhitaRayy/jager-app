<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function checkout()
    {
        $user = Auth::guard('frontend')->user();
        $cartItems = Cart::with('product')->where('frontend_user_id', $user->id)->get();

        return view('frontend.checkout', compact('user', 'cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::guard('frontend')->user();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        Log::info('Placing order for user ID: ' . $user->id);

        // Create order
        $order = Order::create([
            'frontend_user_id' => $user->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $request->total,
            'payment_status' => 'Pending'
        ]);

        Log::info('Order created with ID: ' . $order->id);

        // Create order items
        foreach (json_decode($request->cartItems, true) as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['product']['harga'],
            ]);
        }

        // Generate Snap Token
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $user->email,
                'phone' => $order->phone,
                'address' => $order->address,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            Log::info('Snap token generated: ' . $snapToken);
            return response()->json(['snapToken' => $snapToken, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            Log::error('Error generating snap token: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
    {
        $order = Order::where('id', $request->input('order_id'))->first();

        if ($order && $order->payment_status != 'Paid') {
            // Mengurangi stok barang hanya jika status pembayaran belum "Paid"
            foreach ($order->orderItems as $item) {
                $product = Product::find($item->product_id);
                $product->stok -= $item->quantity;
                $product->save();
            }

            // Mengupdate status pembayaran menjadi "Paid"
            $order->update(['payment_status' => 'Paid']);

            // Mengosongkan keranjang pengguna
            $user = Auth::guard('frontend')->user();
            Cart::where('frontend_user_id', $user->id)->delete();
        }

        return view('frontend.success');
    }

    public function retryPayment(Request $request)
    {
        $order = Order::where('id', $request->input('order_id'))->first();

        if (!$order || $order->payment_status != 'Pending') {
            return response()->json(['error' => 'Order not found or not eligible for retry'], 404);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'email' => $order->user->email,
                'phone' => $order->phone,
                'address' => $order->address,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            return response()->json(['snapToken' => $snapToken, 'order_id' => $order->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orderHistory()
    {
        $user = Auth::guard('frontend')->user();
        $orders = Order::where('frontend_user_id', $user->id)
                        ->with('orderItems.product')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('frontend.order_history', compact('orders'));
    }
}
