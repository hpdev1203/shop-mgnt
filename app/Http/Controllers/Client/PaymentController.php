<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartMD;
use App\Models\CartItem;


class PaymentController extends Controller
{
    public function index()
    {   
        if (isset(Auth::user()->id)) {
            $carts = CartItem::select(
                'cart_item.product_id',
                'cart_item.product_detail_id',
                'cart_item.warehouse_id',
                'cart_item.size_id',
                'cart_item.quantity',
                'cart_item.unit_price_at_time',
                'cart_item.total_amount'
            )
            ->join('cart','cart_item.cart_id','=','cart.id')
            ->where('cart.user_id',Auth::user()->id)->get();
            $sum_cart = 0;
            foreach ($carts as $key => $cart) {
                $sum_cart += $cart->total_amount;
            }
            return view('client.payment',['carts' => $carts,'sum_cart' => $sum_cart]);
        }else{
            return redirect()->route('index');
        }
    }
}
