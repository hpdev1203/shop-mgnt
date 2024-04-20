<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.user.list_user');
    }

    public function add()
    {
        return view('admin.dashboard.user.add_user');
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.dashboard.user.edit_user', ['users' => $users]);
    }
}
