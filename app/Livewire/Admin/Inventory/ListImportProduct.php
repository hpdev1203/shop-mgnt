<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\ImportProduct;
use App\Models\ImportProductDetail;
use App\Models\Warehouse;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListImportProduct extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search_input = '';
    public $list_import_product = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $list_import_product_id = $this->list_import_product[$key]['id'];
                $this->deleteImportProduct($list_import_product_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteImportProduct($id){
        $import_product_detail = ImportProductDetail::where('import_product_id', $id)->get();
        foreach ($import_product_detail as $item) {
            $item->delete();
        }
        $import_products = ImportProduct::find($id);
        $import_products->delete();
    }

    public function handleDetele($id)
    {
        $this->deleteImportProduct($id);
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $import_products = ImportProduct::paginate(10);
        }else{
            $import_products = ImportProduct::where('name', 'like', '%'.$this->search_input.'%')->orWhere('code', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $this->list_import_product = collect($import_products->items());
        return view('livewire.admin.inventory.list-import-product', ['import_products' => $import_products]);
    }
}
