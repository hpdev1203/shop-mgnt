<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.warehouse.index');
    }

    public function add()
    {
        return view('admin.dashboard.warehouse.add_warehouse');
    }

    public function delete($id){
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        return redirect()->route('admin.warehouse');
    }

    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        return view('admin.dashboard.warehouse.edit_warehouse', ['warehouse' => $warehouse]);
    }
}
