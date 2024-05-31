<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index($id)
    {
        if (isset(Auth::user()->id)) {
            return view('client.order_history',['id'=>$id]);
        }else{
            return redirect()->route('login');
        }
    }
}
