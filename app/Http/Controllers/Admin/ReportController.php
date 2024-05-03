<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.report.list_report');
    }

    public function prelim($id)
    {
        return view('admin.dashboard.report.prelim_report', ['id' => $id]);
    }
    public function inventory()
    {
        return view('admin.dashboard.report.inventory_report');
    }
    public function revenue()
    {
        return view('admin.dashboard.report.revenue_report');
    }
    public function brand()
    {
        return view('admin.dashboard.report.brand_report');
    }
    public function customer()
    {
        return view('admin.dashboard.report.customer_report');
    }
}
