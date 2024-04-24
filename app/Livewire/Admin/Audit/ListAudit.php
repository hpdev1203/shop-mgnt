<?php

namespace App\Livewire\Admin\Audit;

use Livewire\Component;
use App\Models\Warehouse;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use OwenIt\Auditing\Models\Audit;

class ListAudit extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';

    public function search()
    {
        $this->resetPage();
    }

    
    
    public function render()
    {
        $id = request()->id;
        $model = request()->view;
        if($model == "Administrator"){
            $model = "User";
        }

        $route = strtolower($model);
        $audits = Audit::where([
            ['auditable_type', '=', 'App\\Models\\'.$model],
            ['auditable_id', '=', $id],
        ])->paginate(10);
     
        return view('livewire.admin.audit.list-audit', ['audits' => $audits,'route'=>$route]);
    }
}
