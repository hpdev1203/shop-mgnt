<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id, $slug)
    {
        $product = Product::find($id);
        return view('client.product-detail', ['product' => $product]);
    }
}
