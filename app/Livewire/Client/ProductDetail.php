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
    public $product_size_id_selected;
    public $product_size_selected;
    public $available_quantity = 0;
    public $product_route;

    public function mount($id)
    {
        $this->product = Product::find($id);
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
        $this->product_size_selected = $this->product->productSizes->first();
        if($this->product_size_selected){
            $this->product_size_id_selected = $this->product_size_selected->id;
        }
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

    public function updateProductSize($id){
        $this->product_size_id_selected = $id;
        $this->product_size_selected = $this->product->productSizes->where('id', $this->product_size_id_selected)->first();
        $this->updateAvailableQuantity();
    }

    public function updateAvailableQuantity(){
        if($this->warehouse_id_selected){
            $this->available_quantity = Warehouse::find($this->warehouse_id_selected)->totalProductAvailable($this->product->id, $this->product_detail_id_selected, $this->product_size_id_selected);
        }else{
            $this->available_quantity = 0;
        }
    }

    public function addToCart(){
        if(!Auth::check()){
            return redirect()->route('login', ['redirect' => $this->product_route]);
        }
        $cart = CartMD::where('user_id', Auth::user()->id)->first();
        if(!$cart){
            $cart = new CartMD();
        }
        $cart->user_id = Auth::user()->id;
        $cart->save();

        $cart_item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $this->product->id)
            ->where('product_detail_id', $this->product_detail_id_selected)
            ->where('warehouse_id', $this->warehouse_id_selected)
            ->where('size_id', $this->product_size_id_selected)
            ->first();
        if($cart_item){
            if($cart_item->quantity >= $this->available_quantity){
                $this->dispatch('alertError', [$this->available_quantity]);
                return;
            }
            $cart_item->quantity += 1;
            $cart_item->total_amount = $cart_item->unit_price_at_time * $cart_item->quantity;
            $cart_item->save();
            $cart_items = $cart->cart_item;
            $this->dispatch('cartUpdated', $cart_items->count());
            return;
        }
        $cart_item = new CartItem();
        $cart_item->cart_id = $cart->id;
        $cart_item->product_id = $this->product->id;
        $cart_item->product_detail_id = $this->product_detail_id_selected;
        $cart_item->warehouse_id = $this->warehouse_id_selected;
        $cart_item->size_id = $this->product_size_id_selected;
        $cart_item->unit_price_at_time = $this->product_detail_selected->retail_price;
        $cart_item->quantity = 1;
        $cart_item->total_amount = $this->product_detail_selected->retail_price;
        $cart_item->save();

        $cart_items = $cart->cart_item;
        $this->dispatch('cartUpdated', $cart_items->count());
    }

    public function render()
    {
        return view('livewire.client.product-detail');
    }
}
