<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.product.index');
    }

    public function add()
    {   
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.dashboard.product.add_product', ['brands' => $brands, 'categories' => $categories]);
    }

    public function edit($id)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $product = Product::find($id);
        return view('admin.dashboard.product.edit_product', ['product' => $product, 'brands' => $brands, 'categories' => $categories]);
    }
}
