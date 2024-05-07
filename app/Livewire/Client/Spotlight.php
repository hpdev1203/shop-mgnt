<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ProductDetail;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Request;

class Spotlight extends Component
{
    use WithPagination, WithoutUrlPagination; 
    
    public $search_input = '';
    public $list_product = [];
    public $selected_index = [];
    public $slug;
    public $search;



    public function render()
    {
        $search = request()->search;
        // Get the last segment of the URL
        $slug = last(array_filter(Request::segments()));
        $category = Category::where('slug', '=', $slug )->first();
        $products = Product::where('name', 'like', '%'.$search.'%')->paginate(8);
        //$products = Product::paginate(8);
        

        return view('livewire.client.spotlight', ['products' => $products]);
    }
}
