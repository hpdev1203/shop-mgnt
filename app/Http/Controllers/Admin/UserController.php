<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where("role","user")->paginate(10);
        return view('admin.dashboard.users.list_user', ['users' => $users]);
    }

    public function add()
    {
        return view('admin.dashboard.users.add_user');
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('admin.dashboard.users.edit_user', ['users' => $users]);
    }
}
