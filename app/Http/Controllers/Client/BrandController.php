<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index($slug)
    {
        $brand = Brand::where('slug',$slug)->first();
        return view('client.brand', ['brand' => $brand]);
    }
}
