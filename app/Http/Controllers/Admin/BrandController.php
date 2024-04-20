<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.brand.index');
    }

    public function add()
    {
        return view('admin.dashboard.brand.add_brand');
    }

    public function delete($id){
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('admin.brands');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.dashboard.brand.edit_brand', ['brand' => $brand]);
    }
}
