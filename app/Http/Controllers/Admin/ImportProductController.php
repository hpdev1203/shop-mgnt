<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\ImportProduct;

class ImportProductController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.inventory.list_import_product');
    }

    public function add()
    {
        return view('admin.dashboard.inventory.add_import_product');
    }
}
