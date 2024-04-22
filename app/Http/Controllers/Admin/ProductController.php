<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.product.index');
    }

    public function add()
    {
        return view('admin.dashboard.product.add_product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.dashboard.product.edit_product', ['product' => $product]);
    }
}
