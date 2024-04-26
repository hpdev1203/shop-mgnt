<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentStatus;

class PaymentStatusController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.payment-status.index');
    }

    public function add()
    {
        return view('admin.dashboard.payment-status.add_payment_status');
    }

    public function edit($id)
    {
        return view('admin.dashboard.payment-status.edit_payment_status', ['payment_status' => $payment_status]);
    }
}
