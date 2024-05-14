<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\TransferWarehouse;
use App\Models\TransferWarehouseDetail;

class EditTransferWarehouse extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $transfer_warehouse = TransferWarehouse::find($this->id);
        $transfer_warehouse_details = TransferWarehouseDetail::where('transfer_product_id',$this->id)->get();
        return view('livewire.admin.inventory.edit-transfer-warehouse', ['transfer_warehouse' => $transfer_warehouse, 'transfer_warehouse_details' => $transfer_warehouse_details]);
    }
}
