<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\Request;

class BrandClient extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $slug;

    public function render()
    {
        $brand = Brand::where('slug',$this->slug)->first();
        $products = Product::where('is_active', '=', '1')->orWhereNull('is_active')->where('brand_id',$brand->id)->orderBy('id', 'desc')->paginate(12);
        return view('livewire.client.brand-client', ['brand' => $brand, 'products' => $products]);
    }
}
