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
            return view('client.order_summaries');
        }else{
            return redirect()->route('login');
        }
    }
}
