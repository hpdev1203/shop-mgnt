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
}
