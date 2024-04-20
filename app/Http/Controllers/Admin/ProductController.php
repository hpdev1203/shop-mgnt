<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.product.index');
    }

    public function add()
    {
        return view('admin.dashboard.category.add_category');
    }

    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.dashboard.category.edit_category', ['category' => $category]);
    }
}
