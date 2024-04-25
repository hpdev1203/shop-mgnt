<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderStatus;

class OrderStatusController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.order-status.index');
    }

    public function add()
    {
        return view('admin.dashboard.order-status.add_order_status');
    }

    public function edit($id)
    {
        $order_status = OrderStatus::find($id);
        return view('admin.dashboard.order-status.edit_order_status', ['order_status' => $order_status]);
    }
}
