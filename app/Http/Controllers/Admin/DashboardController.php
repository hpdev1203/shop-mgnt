<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $total_revenue = Order::where('status', 'completed')->sum('total_amount');
        $total_order = Order::count();
        $total_product = Product::count();
        $total_customer = User::where('role', 'customer')->count();
        $orders_pending = Order::where('status', 'pending')->get();
        return view('admin.dashboard.dashboard', compact('total_revenue', 'total_order', 'total_product', 'total_customer', 'orders_pending'));
    }
}
