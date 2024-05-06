<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ProductDetail;
use App\Models\ProductSize;

class Collection extends Component
{
    use WithPagination, WithoutUrlPagination; 
    
    public $search_input = '';
    public $list_product = [];
    public $selected_index = [];




    public function render()
    {

        if($this->search_input == ''){
            $products = Product::with(['productDetails' => function ($query) {
                $query->where('image', '!=', null)->take(1);
            }])->paginate(8);
        } else {
            $products = Product::where('name', 'like', '%'.$this->search_input.'%')->orWhere('code', 'like', '%'.$this->search_input.'%')->with(['productDetails' => function ($query) {
                $query->where('image', '!=', null)->take(1);
            }])->paginate(8);
        }
        return view('livewire.client.collection', ['products' => $products]);
    }
}
