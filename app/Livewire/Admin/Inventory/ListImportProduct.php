<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\ImportProduct;
use App\Models\ImportProductDetail;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListImportProduct extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search_input = '';
    public $code = '';
    public $list_product = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $import_products = ImportProduct::orderBy('created_at','desc')->paginate(10);
        }else{
            $import_products = ImportProduct::where('name', 'like', '%'.$this->search_input.'%')
            ->orWhere('code', 'like', '%'.$this->search_input.'%')
            ->orderBy('created_at','desc')->paginate(10);
        }
        $this->list_product = collect($import_products->items());
        return view('livewire.admin.inventory.list-import-product', ['import_products' => $import_products]);
    }
    
    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $product_id = $this->list_product[$key]['id'];
                $this->deleteProduct($product_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }
    public function deleteProduct($id){
        $product = ImportProduct::find($id);
        $product_detail = ImportProductDetail::where('import_product_id', $id)->get();
        foreach ($product_detail as $item) {
            $item->delete();
        }
        $product->delete();
    }

    public function updateImportProduct($id,$code){
        ImportProductDetail::where('import_product_id', $id)
            ->update([
                'quantity' => 0,
            ]);
            $this->dispatch('successPayment', [
                'title' => 'Thành công',
                'message' => 'Đã đặt thành công Mã nhập hàng ',
                'type' => 'success'
            ]);
        
    }
}
