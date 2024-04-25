<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System;

class SystemInformationController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.system.index');
    }
}
