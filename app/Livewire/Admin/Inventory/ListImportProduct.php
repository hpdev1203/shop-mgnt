<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\ImportProduct;
use App\Models\Warehouse;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListImportProduct extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search_input = '';

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $import_products = ImportProduct::find($id);
        $import_products->delete();
        session()->flash('success', 'Đã xóa thành công');
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $import_products = ImportProduct::paginate(10);
        }else{
            $import_products = ImportProduct::where('name', 'like', '%'.$this->search_input.'%')->orWhere('code', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        return view('livewire.admin.inventory.list-import-product', ['import_products' => $import_products]);
    }
}
