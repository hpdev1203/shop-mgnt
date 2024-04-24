<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\TransferWarehouse;

class TransferWarehouseController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.inventory.list_transfer_warehouse');
    }

    public function add()
    {
        return view('admin.dashboard.inventory.add_transfer_warehouse');
    }

    public function edit($id)
    {
        $transfer_warehouses = TransferWarehouse::find($id);
        return view('admin.dashboard.inventory.edit_transfer_warehouse', ['transfer_warehouses' => $transfer_warehouses]);
    }
}
