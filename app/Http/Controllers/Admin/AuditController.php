<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;

class AuditController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.audit.index');
    }

    public function add()
    {
        return view('admin.dashboard.audit.add_audit');
    }

    public function delete($id){
        $audit = Warehouse::find($id);
        $audit->delete();
        return redirect()->route('admin.audit');
    }

    public function edit($id)
    {
        $audit = Warehouse::find($id);
        return view('admin.dashboard.audit.edit_audit', ['audit' => $audit]);
    }
    public function detail($id)
    {
        $audit = Warehouse::find($id);
        return view('admin.dashboard.audit.detail_audit', ['audit' => $audit]);
    }
}
