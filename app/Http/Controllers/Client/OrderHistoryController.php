<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;

class OrderHistoryController extends Controller
{
    public function index($id)
    {
        if (isset(Auth::user()->id)) {
            $order_details = OrderDetail::join('orders','order_detail.order_id','=','orders.id')
                ->where('orders.user_id',Auth::user()->id)
                ->where('order_detail.order_id',$id)->get();
            $order = Order::where('user_id',Auth::user()->id)
                ->where('id',$id)->first();
            $tracking_orders = OrderStatus::where('order_id', $id)->get();
            return view('client.order_history',['order_details' => $order_details, 'order' => $order , 'tracking_orders' => $tracking_orders]);
        }else{
            return redirect()->route('index');
        }
    }
}
