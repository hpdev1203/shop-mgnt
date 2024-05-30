<?php

namespace App\Livewire\Client;

use App\Models\CartItem;
use App\Models\CartMD;
use App\Models\Warehouse;
use Livewire\Component;
use App\Models\Product;
use Auth;


class ProductDetail extends Component
{
    public $product;
    public $product_details;
    public $product_warehouses;
    public $product_sizes;
    public $warehouse_id_selected;
    public $warehouse_selected;
    public $product_detail_id_selected;
    public $product_detail_selected;
    public $product_detail_images_selected = [];
    public $product_detail_image_default = "";
    public $available_quantity = 0;
    public $product_route;
    public $product_id;

    public function mount($id)
    {
        $this->product = Product::find($id);
        $this->product_id = $id;
        $this->product_route = route('product-detail', ['id' => $id, 'slug' => $this->product->slug]);
        $this->product_details = $this->product->productDetails;
        $this->product_sizes = $this->product->productSizes;
        $this->product_warehouses = $this->product->warehouses();
        $this->warehouse_selected = $this->product_warehouses->first();
        if($this->warehouse_selected){
            $this->warehouse_id_selected = $this->warehouse_selected->id;
        }
        $this->product_detail_selected = $this->product_details->first();
        $this->product_detail_id_selected = $this->product_detail_selected->id;

        $this->updateProductDetailImage();
        $this->updateAvailableQuantity();
    }

    public function updateProductDetailImage(){
        if($this->product_detail_selected->image != null){
            $this->product_detail_images_selected = json_decode($this->product_detail_selected->image);
            $this->product_detail_image_default = asset('storage/images/products/' . $this->product_detail_images_selected[0]);
        }else{
            $this->product_detail_images_selected = [];
            $this->product_detail_image_default = asset('library/images/image-not-found.jpg');
        }
    }

    public function updateWarehouse()
    {
        $this->warehouse_selected = $this->product_warehouses->where('id', $this->warehouse_id_selected)->first();
        $this->updateAvailableQuantity();
    }

    public function updateProductDetail($id){
        $this->product_detail_id_selected = $id;
        $this->product_detail_selected = $this->product_details->where('id', $this->product_detail_id_selected)->first();
        $this->updateProductDetailImage();
        $this->updateAvailableQuantity();
    }

    public function updateAvailableQuantity(){
        if($this->warehouse_id_selected){
            $this->available_quantity = Warehouse::find($this->warehouse_id_selected)->totalProductAvailable($this->product->id, $this->product_detail_id_selected, null);
        }else{
            $this->available_quantity = 0;
        }
    }

    public function render()
    {
        return view('livewire.client.product-detail');
    }
}
