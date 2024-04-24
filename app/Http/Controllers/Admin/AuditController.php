<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function index()
    {   
        $id = request()->id;
        $model = request()->view;
        $route = strtolower($model);
            
        return view('admin.dashboard.audit.list_audit', ['id' => $id,'route'=>$route]);
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
        $audit = Audit::find($id);
        $model = request()->view;
        $route = strtolower($model);
        return view('admin.dashboard.audit.detail_audit', ['audit' => $audit,'route'=>$route]);
    }
}
