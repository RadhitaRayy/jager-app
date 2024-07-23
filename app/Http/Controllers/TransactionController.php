<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('search')) {
            $query->whereHas('frontendUser', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $transactions = $query->orderBy('created_at', 'desc')->get();

        return view('admin.transaksi.transaksi', compact('transactions'));
    }

    public function updateShipping(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:orders,id',
            'shipping_status' => 'required|string',
            'shipping_details' => 'nullable|string',
        ]);

        $order = Order::find($request->transaction_id);
        $order->shipping_status = $request->shipping_status;
        $order->shipping_details = $request->shipping_details;
        $order->save();

        return redirect()->route('admin.transaksi')->with('status', 'Shipping status updated successfully!');
    }

    public function show($id)
    {
        $transaction = Order::with('frontendUser', 'orderItems.product')->findOrFail($id);
        return view('admin.transaksi.show', compact('transaction'));
    }
}
