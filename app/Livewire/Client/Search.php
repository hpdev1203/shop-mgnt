<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Product;

class Search extends Component
{
    public $input_search = '';

    public function search()
    {
        $this->render();
    }

    public function closeSearch()
    {
        $this->input_search = "";
        $this->render();
    }
    
    public function render()
    {
        $product_search = "";
        if($this->input_search != ''){
            $product_search =  Product::where('name', 'like', '%'.$this->input_search.'%')
                ->orWhere('code', 'like', '%'.$this->input_search.'%')
                ->where(function($query) {
                    $query->where('is_active', '=', '1')->orWhereNull('is_active');
                })
                ->orderBy('name','asc')->get();
        }
        return view('livewire.client.search', ["product_search" => $product_search]);
    }
}
