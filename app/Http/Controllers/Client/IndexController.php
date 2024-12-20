<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class IndexController extends Controller
{
    public function forgot_password(){
        return view('client.forgot_password');
    }
    public function index()
    {   
        $new_products = Product::where('is_active', '=', '1')->orWhereNull('is_active')->orderBy('id', 'desc')->limit(8)->get();
        $best_seller_products = OrderDetail::select('product_id', DB::raw('SUM(quantity) as total_quantity'))->groupBy('product_id')->orderBy('total_quantity', 'desc')->limit(8)->get();
        $brands = Brand::orderBy('id', 'desc')->limit(8)->get();
        return view('client.index', ['new_products' => $new_products, 'best_seller_products' => $best_seller_products, 'brands' => $brands]);
    }
}
