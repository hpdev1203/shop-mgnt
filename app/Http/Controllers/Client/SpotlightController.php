<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;

class SpotlightController extends Controller
{
    public function index()
    {   
        $search = request()->search;
        $id_user = 0;
        if (isset(Auth::user()->id)) {
            $id_user = Auth::user()->id;
        }
        $user = User::where('id',$id_user)->where('role','customer')->first();

        $products = Product::all();
        return view('client.spotlight', ['user' => $user,'search'=>$search]);
    }
    public function search()
    {
        $input_search = $_GET['input_search'];
        return redirect()->route('spotlight',['search'=>$input_search]);
    }
}
