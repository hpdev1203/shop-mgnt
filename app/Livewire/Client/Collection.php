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

class Collection extends Component
{
    use WithPagination, WithoutUrlPagination; 
    
    public $search_input = '';
    public $list_product = [];
    public $selected_index = [];
    public $slug;



    public function render()
    {
        // Get the last segment of the URL
        $slug = last(array_filter(Request::segments()));
        $category = Category::where('slug', '=', $slug )->first();
        $products = Product::where('category_id', '=', $category->id)->paginate(8);

        return view('livewire.client.collection', ['products' => $products,'category'=>$category]);
    }
}
