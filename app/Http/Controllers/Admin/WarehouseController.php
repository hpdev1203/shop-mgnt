<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouses;

class WarehouseController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.warehouse.index');
    }

    public function add()
    {
        return view('admin.dashboard.warehouse.add_warehouses');
    }

    public function delete($id){
        $warehouses = Warehouses::find($id);
        $warehouses->delete();
        return redirect()->route('admin.warehouses');
    }

    public function edit($id)
    {
        $warehouses = Warehouses::find($id);
        return view('admin.dashboard.warehouse.edit_warehouses', ['warehouses' => $warehouses]);
    }
}
