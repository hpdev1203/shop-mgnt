<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $selected_id;

    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        if($this->search_input == ''){
            $products = Product::leftJoin('product_detail', 'products.id', '=', 'product_detail.product_id')
                ->select('products.*', 'product_detail.image')
                ->paginate(10);
        }else{
            $products = Product::leftJoin('product_detail', 'products.id', '=', 'product_detail.product_id')
                ->select('products.*', 'product_detail.image')
                ->where('products.name', 'like', '%'.$this->search_input.'%')
                ->orWhere('products.description', 'like', '%'.$this->search_input.'%')
                ->paginate(10);
        }
        return view('livewire.admin.product.list-product', ['products' => $products]);
    }
}
