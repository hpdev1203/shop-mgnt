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
    public $list_warehouse = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $warehouse_id = $this->list_warehouse[$key]['id'];
                $this->deleteWarehouse($warehouse_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteWarehouse($id){
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        session()->flash('success', 'Warehouse deleted successfully');
    }

    public function handleDetele($id)
    {
        $this->deleteWarehouse($id);
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $warehouses = Warehouse::paginate(10);
        }else{
            $warehouses = Warehouse::where('name', 'like', '%'.$this->search_input.'%')->orWhere('address', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $this->list_warehouse = collect($warehouses->items());
        return view('livewire.admin.warehouse.list-warehouse', ['warehouses' => $warehouses]);
    }
}
