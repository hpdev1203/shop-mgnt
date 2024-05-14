<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\TransferWarehouse;
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
    
    public function render()
    {
        if($this->search_input == ''){
            $transfer_warehouses = TransferWarehouse::orderBy('created_at','desc')->paginate(10);
        }else{
            $transfer_warehouses = TransferWarehouse::where('name', 'like', '%'.$this->search_input.'%')
            ->orWhere('code', 'like', '%'.$this->search_input.'%')
            ->orderBy('created_at','desc')->paginate(10);
        }
        return view('livewire.admin.inventory.list-transfer-warehouse', ['transfer_warehouses' => $transfer_warehouses]);
    }
}
