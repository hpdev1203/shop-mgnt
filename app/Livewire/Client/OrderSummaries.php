<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Carbon\Carbon;

class OrderSummaries extends Component
{
    public $from_date = "";
    public $to_date = "";
    public $filter_order_summaries_yn = "n";

    public function filter_order_summaries(){
        $this->filter_order_summaries_yn = "y";
        $this->render();
    }

    public function render()
    {
        $paid = 0;
        $unpaid = 0;
        if ($this->filter_order_summaries_yn == "n") {
            $vle_fromdate = Carbon::create(now()->year,now()->month,1,0,0,0);
            $vle_todate = Carbon::create(now()->year,now()->month,now()->daysInMonth,0,0,0);
            $this->from_date = $vle_fromdate->format('Y-m-d');
            $this->to_date = $vle_todate->format('Y-m-d');
            
            $orders = Order::where('user_id',Auth::user()->id)
                ->orderBy('order_date', 'desc')
                ->orderBy('id', 'desc')->get();
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
        }else{
            $orders = Order::where('user_id',Auth::user()->id)
                ->whereBetween('order_date', [$this->from_date, $this->to_date])
                ->orderBy('order_date', 'desc')
                ->orderBy('id', 'desc')->get();
            $paid_order = Order::select('user_id', Order::raw('SUM(total_amount) as total'))
                ->where('user_id',Auth::user()->id)
                ->where('payment_status','paid')
                ->whereBetween('order_date', [$this->from_date, $this->to_date])
                ->groupBy('user_id')
                ->first();
            if (isset($paid_order)) {
                $paid = (int)$paid_order->total;
            }
            $unpaid_order = Order::select('user_id', Order::raw('SUM(total_amount) as total'))
                ->where('user_id',Auth::user()->id)
                ->where('payment_status','pending')
                ->where('status','<>','rejected')
                ->whereBetween('order_date', [$this->from_date, $this->to_date])
                ->groupBy('user_id')
                ->first();
            if (isset($unpaid_order)) {
                $unpaid = (int)$unpaid_order->total;
            }
        }
        
        $sum_paid = $paid + $unpaid;
        return view('livewire.client.order-summaries',['orders' => $orders,'paid' => $paid, 'unpaid' => $unpaid, 'sum_paid' => $sum_paid]);
    }
}
