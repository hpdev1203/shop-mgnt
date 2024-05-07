<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {   
        if (isset(Auth::user()->id)) {
            return view('client.payment');
        }else{
            return redirect()->route('index');
        }
    }
}
