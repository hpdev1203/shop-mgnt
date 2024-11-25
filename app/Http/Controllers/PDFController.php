<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\ProductDetail;
use App\Models\User;
use App\Models\System;

class PDFController extends Controller
{
    public function index(){

    }
    public function generatePDF()
    {
        $orderId = request()->route('id');
        $order = Order::find($orderId);
        if (!$order) {
            abort(404);
        }
        $user = User::find($order->user_id);
        $username = $user->name;
        $orderDetails = OrderDetail::where('order_id', $orderId)->get()->map(function ($detail) {
            return [
                'name' => $detail->product_detail->product->name,
                'quantity' => $detail->quantity,
                'price' => $detail->unit_price,
                'total' => $detail->quantity * $detail->unit_price,
            ];
        });
        $total_quantity = $orderDetails->sum('quantity');   
        $total_price = $orderDetails->sum('total');
        $discount = $order->discount_amount;
        $debt = $order->debt;
        
        $date = date('d');
        $month = date('m');
        $year = date('Y');
        $date_now = 'Ngày ' . $date . ' tháng ' . $month . ' năm ' . $year;
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Set the timezone to your local timezone

        $orderDate = $order->order_date; // Get the order date of the current order
        $totalUnpaid_user = Order::where('user_id', '=', $order->user_id)->where('id', '<>', $orderId)->where('order_date', '<', now())->where('payment_status', '=', 'pending')->whereHas('orderStatus', function($query) {
            $query->where('status', '!=', 'rejected')
                  ->orWhereNull('status');
        })->sum('total_amount');
      
        
        $time = date('H:i');
        $title = System::first()->website;
        $hotline = System::first()->phone;   
        $address = System::first()->address." - ".System::first()->city." - ".System::first()->state;
        $data = [
            'title' => $title,
            'hotline' => $hotline,
            'date_now' => $date_now,
            'time' => $time,
            'orderDetails' => $orderDetails,
            'total_quantity' => $total_quantity,
            'total_price' => $total_price,
            'discount' => $discount,
            'debt' => $debt,
            'username' => $username,
            'totalUnpaid_user' => $totalUnpaid_user,
            'address' => $address,
            'discount_percent' => $order->discount_percent,
        ];

        $pdf = PDF::loadView('admin.dashboard.order.pdf_view', $data);
        $pdf->setPaper('A4', 'portrait');

        // Set font tiếng Việt
        $pdf->set_option('defaultFont', 'DejaVuSans');
        $filename = 'Hóa đơn '.$order->code.'.pdf';
        return $pdf->download($filename);
    }
}
