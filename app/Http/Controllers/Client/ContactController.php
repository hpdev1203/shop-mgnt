<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    { 
        if (isset(Auth::user()->id)) {
            return view('client.contact');
        }else{
            return redirect()->route('login');
        }
    }
}
