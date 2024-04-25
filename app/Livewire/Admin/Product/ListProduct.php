<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ProductDetail;
use App\Models\ProductSize;

class ListProduct extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_product = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
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
        $product = Product::find($id);
        $checkOrder = $product->orderDetails;
        if(count($checkOrder) > 0){
            $this->dispatch('error', ['error' => 'Sản phẩm '.$product->name.' đã được đặt hàng, vì vậy không thể xóa. Vui lòng chỉ ẩn để đảm bảo tính đúng đắn của dử liệu.']);
            return;
        }
        $product_size = ProductSize::where('product_id', $id)->get();
        foreach ($product_size as $item) {
            $item->delete();
        }
        $product_detail = ProductDetail::where('product_id', $id)->get();
        foreach ($product_detail as $item) {
            $item->delete();
        }
        $product->delete();
    }

    public function handleDetele($id)
    {
        $this->deleteProduct($id);
        $this->render();
    }

    public function render()
    {
        if($this->search_input == ''){
            $products = Product::with(['productDetails' => function ($query) {
                $query->where('image', '!=', null)->take(1);
            }])->paginate(10);
        } else {
            $products = Product::where('name', 'like', '%'.$this->search_input.'%')->orWhere('code', 'like', '%'.$this->search_input.'%')->with(['productDetails' => function ($query) {
                $query->where('image', '!=', null)->take(1);
            }])->paginate(10);
        }
        
        $this->list_product = collect($products->items());

        return view('livewire.admin.product.list-product', ['products' => $products]);
    }

}
