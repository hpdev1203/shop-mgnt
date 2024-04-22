<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ProductDetail;

class ListProduct extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $selected_id;

    public function search()
    {
        $this->resetPage();
    }

    public function handleDetele($id)
    {
        $product_detail = ProductDetail::where('product_id', $id)->get();
        foreach ($product_detail as $item) {
            $item->delete();
        }
        $product = Product::find($id);
        $product->delete();

       
        session()->flash('success', 'Brand deleted successfully');
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
        return view('livewire.admin.product.list-product', ['products' => $products]);
    }

}
