<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ShowProductController extends Controller
{
    public function index()
    {   
        $id_user = 0;
        if (isset(Auth::user()->id)) {
            $id_user = Auth::user()->id;
        }
        $user = User::where('id',$id_user)->where('role','customer')->first();
        return view('client.product', ['user' => $user]);
    }
}
