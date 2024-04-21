<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as Administrator;

class AdministratorController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.administrator.list_administrator');
    }

    public function add()
    {
        return view('admin.dashboard.administrator.add_administrator');
    }

    public function edit($id)
    {
        $administrators = Administrator::find($id);
        return view('admin.dashboard.administrator.edit_administrator', ['administrators' => $administrators]);
    }
}
