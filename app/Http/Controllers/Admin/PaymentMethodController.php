<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.payment-method.index');
    }

    public function add()
    {
        return view('admin.dashboard.payment-method.add_payment_method');
    }

    public function edit($id)
    {
        $payment_method = PaymentMethod::find($id);
        return view('admin.dashboard.payment-method.edit_payment_method', ['payment_method' => $payment_method]);
    }
}
