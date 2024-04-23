<?php

namespace App\Livewire\Admin\Audit;

use Livewire\Component;
use App\Models\Warehouse;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListAudit extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $id = '';

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $audits = Warehouse::find($id);
        $audits->delete();
        session()->flash('success', 'Warehouse deleted successfully');
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $audits = Warehouse::paginate(10);
        }else{
            $audits = Warehouse::where('name', 'like', '%'.$this->search_input.'%')->orWhere('address', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $id= request()->id;
        
        $audit = Warehouse::find($id);
        $audits = $audit->audits;
        
        // $audit = $audits->audits()->first();
        // dd($audits->audits);
        // $json_audit = $audits->getMetadata(true, JSON_PRETTY_PRINT);
        // dd($json_audit);
        return view('livewire.admin.audit.list-audit', ['audits' => $audits]);
    }
}
