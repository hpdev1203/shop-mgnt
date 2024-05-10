<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoAdminController extends Controller
{
    public function change_password()
    {   
        return view('admin.dashboard.system.change_password');
    }

    public function index()
    {   
        return view('admin.dashboard.system.info_admin');
    }
}
