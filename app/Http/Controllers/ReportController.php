<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function salesReport(Request $request)
    {
        // Default ke laporan bulan ini
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('payment_status', 'Paid')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalRevenue = $orders->sum('total');

        return view('admin.laporan.sales', compact('orders', 'totalRevenue', 'startDate', 'endDate'));
    }

    public function stockReport()
    {
        $products = Product::orderBy('stok', 'asc')->get(); // Urutkan berdasarkan stok terendah

        return view('admin.laporan.stock', compact('products'));
    }
}
