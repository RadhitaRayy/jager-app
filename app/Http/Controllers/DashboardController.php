<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $totalCategories = Category::count();
        $totalProducts = Product::count();

        // Default to monthly view
        $filter = $request->input('filter', 'monthly');

        if ($filter == 'weekly') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
            $sales = Order::select(
                DB::raw('YEARWEEK(created_at, 1) as week'),
                DB::raw('SUM(total) as total')
            )
            ->where('payment_status', 'Paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('week')
            ->orderBy('week', 'asc')
            ->get();
            $labels = $sales->pluck('week')->map(function ($week) {
                return 'Week ' . Carbon::now()->setISODate(Carbon::now()->year, substr($week, -2))->weekOfYear;
            });
        } elseif ($filter == 'yearly') {
            $sales = Order::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(total) as total')
            )
            ->where('payment_status', 'Paid')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
            $labels = $sales->pluck('year');
        } else {
            $sales = Order::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(total) as total')
            )
            ->where('payment_status', 'Paid')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
            $labels = $sales->pluck('month');
        }

        return view('dashboard', compact('totalCategories', 'totalProducts', 'sales', 'labels', 'filter'));
    }
}
