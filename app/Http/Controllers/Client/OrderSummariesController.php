<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderSummariesController extends Controller
{
    public function index()
    {
        if (isset(Auth::user()->id)) {
            $paid = 0;
            $unpaid = 0;
            $orders = Order::where('user_id',Auth::user()->id)->orderBy('order_date', 'desc')->orderBy('id', 'desc')->get();
            $paid_order = Order::select('user_id', Order::raw('SUM(total_amount) as total'))
                ->where('user_id',Auth::user()->id)
                ->where('payment_status','paid')
                ->groupBy('user_id')
                ->first();
            if (isset($paid_order)) {
                $paid = (int)$paid_order->total;
            }
            $unpaid_order = Order::select('user_id', Order::raw('SUM(total_amount) as total'))
                ->where('user_id',Auth::user()->id)
                ->where('payment_status','pending')
                ->where('status','<>','rejected')
                ->groupBy('user_id')
                ->first();
            if (isset($unpaid_order)) {
                $unpaid = (int)$unpaid_order->total;
            }
            $sum_paid = $paid + $unpaid;
            return view('client.order_summaries',['orders' => $orders,'paid' => $paid, 'unpaid' => $unpaid, 'sum_paid' => $sum_paid]);
        }else{
            return redirect()->route('index');
        }
    }
}
