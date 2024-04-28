<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.order.index');
    }

    public function add(){
        return view('admin.dashboard.order.add_order');
    }

    public function edit($id){
        $order = Order::find($id);
        return view('admin.dashboard.order.edit_order', ['order' => $order]);
    }
}
