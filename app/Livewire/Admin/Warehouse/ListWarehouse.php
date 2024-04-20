<?php

namespace App\Livewire\Admin\Warehouse;

use Livewire\Component;
use App\Models\Warehouse;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListWarehouse extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $warehouses = Warehouse::find($id);
        $warehouses->delete();
        session()->flash('success', 'Warehouse deleted successfully');
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $warehouses = Warehouse::paginate(10);
        }else{
            $warehouses = Warehouse::where('name', 'like', '%'.$this->search_input.'%')->orWhere('address', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        return view('livewire.admin.warehouse.list-warehouse', ['warehouses' => $warehouses]);
    }
}
