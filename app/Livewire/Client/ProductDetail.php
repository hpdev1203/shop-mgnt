<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\Product;

class ProductDetail extends Component
{
    public $product;
    public $product_details;
    public $warehouse_id;
    public $product_warehouses;
    public $warehouse_selected;
    public $productDetailId;
    public $available_quantity = 0;

    public function mount($id)
    {
        $this->product = Product::find($id);
        $this->product_details = $this->product->productDetails;
        $this->product_warehouses = $this->product->warehouses();
        $this->warehouse_selected = $this->product_warehouses->first();
        $this->warehouse_id = $this->warehouse_selected->id;
        $this->productDetailId = $this->product_details->first()->id;
    }

    public function updateWarehouse()
    {
        $this->warehouse_selected = $this->product_warehouses->where('id', $this->warehouse_id)->first();
    }

    public function updateProductDetail(){
        $this->productDetailId = $this->product_details->where('id', $this->productDetailId)->first()->id;
    }

    public function render()
    {
        return view('livewire.client.product-detail');
    }
}
