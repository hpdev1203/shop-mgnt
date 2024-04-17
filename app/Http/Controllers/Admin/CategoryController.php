<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.dashboard.categories.index', ['categories' => $categories]);
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
