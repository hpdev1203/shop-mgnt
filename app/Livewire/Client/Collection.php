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
    public $slug;

    public function render()
    {
        $category = Category::where('slug', '=', $this->slug )->first();
        $products = Product::where('is_active', '=', '1')->orWhereNull('is_active')->where('category_id', '=', $category->id)->paginate(8);
        return view('livewire.client.collection', ['products' => $products,'category'=>$category]);
    }
}
