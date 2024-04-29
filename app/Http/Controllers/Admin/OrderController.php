<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.order.index');
    }

    public function add(){
        $customers = User::where('role', 'customer')->get();
        $payment_methods = PaymentMethod::all();
        $products = Product::all();
        return view('admin.dashboard.order.add_order', ['customers' => $customers, 'payment_methods' => $payment_methods, 'products' => $products]);
    }

    public function edit($id){
        $order = Order::find($id);
        return view('admin.dashboard.order.edit_order', ['order' => $order]);
    }
}
