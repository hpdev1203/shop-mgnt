<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\TransferWarehouse;
use App\Models\TransferWarehouseDetail;
use App\Models\Warehouse;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListTransferWarehouse extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search_input = '';
    public $list_transfer_warehouse = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $list_transfer_warehouse_id = $this->list_transfer_warehouse[$key]['id'];
                $this->deleteTransferWarehouse($list_transfer_warehouse_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteTransferWarehouse($id){
        $transfer_warehouse_detail = TransferWarehouseDetail::where('transfer_product_id', $id)->get();
        foreach ($transfer_warehouse_detail as $item) {
            $item->delete();
        }
        $transfer_warehouses = TransferWarehouse::find($id);
        $transfer_warehouses->delete();
    }

    public function handleDetele($id)
    {
        $this->deleteTransferWarehouse($id);
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $transfer_warehouses = TransferWarehouse::paginate(10);
        }else{
            $transfer_warehouses = TransferWarehouse::where('name', 'like', '%'.$this->search_input.'%')->orWhere('code', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $this->list_transfer_warehouse = collect($transfer_warehouses->items());
        return view('livewire.admin.inventory.list-transfer-warehouse', ['transfer_warehouses' => $transfer_warehouses]);
    }
}
