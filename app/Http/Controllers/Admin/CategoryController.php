<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.categories.index');
    }

    public function add()
    {
        return view('admin.dashboard.categories.add_category');
    }

    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.dashboard.categories.edit_category', ['category' => $category]);
    }
}
