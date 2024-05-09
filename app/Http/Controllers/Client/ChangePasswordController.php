<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChangePasswordController extends Controller
{
    public function index()
    {   
        if (isset(Auth::user()->id)) {
            return view('client.change_password');
        }else{
            return redirect()->route('login');
        }
    }
}
