<?php

namespace App\Livewire\Admin\Warehouses;

use Livewire\Component;
use App\Models\Warehouses;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListWarehouses extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $warehouses = Warehouses::find($id);
        $warehouses->delete();
        session()->flash('success', 'Warehouses deleted successfully');
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $warehouses = Warehouses::paginate(10);
        }else{
            $warehouses = Warehouses::where('name', 'like', '%'.$this->search_input.'%')->orWhere('address', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        return view('livewire.admin.warehouses.list-warehouses', ['warehouses' => $warehouses]);
    }
}
