<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;


class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('admin.dashboard.brands.index', ['brands' => $brands]);
    }

    public function add()
    {
        return view('admin.dashboard.brands.add_brand');
    }

    public function delete($id){
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('admin.brands');
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.dashboard.brands.edit_brand', ['brand' => $brand]);
    }
}
