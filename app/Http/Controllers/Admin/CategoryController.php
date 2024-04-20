<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.category.index');
    }

    public function add()
    {
        return view('admin.dashboard.category.add_category');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.dashboard.category.edit_category', ['category' => $category]);
    }
}
