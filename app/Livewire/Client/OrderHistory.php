<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;

class OrderHistory extends Component
{
    public $id;
    public $list_size = [];

    public function show_size($stt,$order_id,$product_id,$product_detail_id){
        $this->close_size();
        $this->list_size[$stt] = OrderDetail::where('order_id',$order_id)
        ->where('product_id',$product_id)
        ->where('product_detail_id',$product_detail_id)
        ->orderBy('size_id', 'desc')->get();
    }

    public function close_size(){
        $this->list_size = [];
    }

    public function render()
    {
        $order_details = OrderDetail::select(
            'order_detail.order_id',
            'order_detail.product_id',
            'order_detail.product_detail_id',
            OrderDetail::raw('SUM(order_detail.quantity) as quantity'),
            OrderDetail::raw('SUM(order_detail.total_amount) as total_amount')
        )
        ->join('orders','order_detail.order_id','=','orders.id')
        ->where('orders.user_id',Auth::user()->id)
        ->where('order_detail.order_id',$this->id)
        ->groupBy(
            'order_detail.order_id',
            'order_detail.product_id',
            'order_detail.product_detail_id',
        )
        ->orderBy('order_detail.id', 'desc')->get();
        
        $order = Order::where('user_id',Auth::user()->id)
            ->where('id',$this->id)->first();

        $tracking_orders = OrderStatus::where('order_id', $this->id)->get();

        return view('livewire.client.order-history',['order_details' => $order_details, 'order' => $order , 'tracking_orders' => $tracking_orders, 'list_size' => $this->list_size]);
    }
}
