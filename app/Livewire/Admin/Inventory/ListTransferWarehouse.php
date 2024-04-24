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

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $transfer_warehouse_detail = TransferWarehouseDetail::where('transfer_product_id', $id)->get();
        foreach ($transfer_warehouse_detail as $item) {
            $item->delete();
        }
        $transfer_warehouses = TransferWarehouse::find($id);
        $transfer_warehouses->delete();
        session()->flash('success', 'Đã xóa thành công');
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $transfer_warehouses = TransferWarehouse::paginate(10);
        }else{
            $transfer_warehouses = TransferWarehouse::where('name', 'like', '%'.$this->search_input.'%')->orWhere('code', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        return view('livewire.admin.inventory.list-transfer-warehouse', ['transfer_warehouses' => $transfer_warehouses]);
    }
}
