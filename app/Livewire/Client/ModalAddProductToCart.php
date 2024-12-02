<?php

namespace App\Livewire\Client;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\ProductDetail as PrdDetail;
use App\Models\Warehouse;
use App\Models\ProductSize;
use App\Models\CartMD;
use App\Models\CartItem;
use Auth;

class ModalAddProductToCart extends ModalComponent
{
    public $warehouse_id;
    public $product_id;
    public $product_detail_id;
    public $product;
    public $product_sizes;
    public $warehouse;
    public $listProductAdded = [];
    public $listProductAddedError = [];
    public $totalQuantity = 0;
    public $totalAmount = 0;
    public $mode;

    public function mount($product_id, $warehouse_id_selected, $product_detail_id_selected, $cart_id, $mode)
    {
        $this->product_id = $product_id;
        $this->warehouse_id = $warehouse_id_selected;
        $this->product_detail_id = $product_detail_id_selected;
        $this->product = PrdDetail::find($product_detail_id_selected);
        $this->product_sizes = $this->product->product->productSizes;
        $this->warehouse = Warehouse::find($warehouse_id_selected);
        $this->cart_id = $cart_id;
        $this->mode = $mode;
        foreach ($this->product_sizes as $key => $size) {
            if($this->cart_id != ''){
                $qnty = CartItem::where('cart_id',$this->cart_id)
                ->where('size_id',$size->id)
                ->where('product_id',$this->product_id)
                ->where('product_detail_id',$this->product_detail_id)
                ->first();
                if(isset($qnty->quantity)){
                    $this->listProductAdded[$size->id] = $qnty->quantity;
                    $this->totalQuantity += $qnty->quantity;
                }else{
                    $this->listProductAdded[$size->id] = 0;
                    $this->totalQuantity += 0;
                }
            }else{
                $this->listProductAdded[$size->id] = 0;
            }
            $this->listProductAddedError[$size->id] = "";
        }
        if($this->mode == 'edit'){
            $this->totalAmount =  $this->totalQuantity*$this->product->product->retail_price;
        }
    }
    public function addQuantity($product_size_id)
    {
        $this->listProductAddedError[$product_size_id] = "";
        $available_quantity = Warehouse::find($this->warehouse_id)->totalProductAvailable($this->product->product_id, $this->product_detail_id, $product_size_id);
        if ($this->listProductAdded[$product_size_id] < $available_quantity){
            $this->listProductAdded[$product_size_id]++;
        }else{
            $this->listProductAddedError[$product_size_id] = "Tối đa ". $available_quantity . " sản phẩm";
        }
        $this->updateTotal();
    }
    public function reduceQuantity($product_size_id)
    {
        $this->listProductAddedError[$product_size_id] = "";
        if($this->mode == 'edit'){
            if ($this->listProductAdded[$product_size_id] > 1) {
                $this->listProductAdded[$product_size_id]--;
            }
        }else{
            if ($this->listProductAdded[$product_size_id] > 0) {
                $this->listProductAdded[$product_size_id]--;
            }
        }
        $this->updateTotal();
    }


    public function changeQty($product_size_id)
    {
        $this->listProductAddedError[$product_size_id] = "";
        $available_quantity = Warehouse::find($this->warehouse_id)->totalProductAvailable($this->product->product_id, $this->product_detail_id, $product_size_id);
        if ($this->listProductAdded[$product_size_id] > $available_quantity){
            $this->listProductAddedError[$product_size_id] = "Tối đa ". $available_quantity . " sản phẩm";
            $this->listProductAdded[$product_size_id] = $available_quantity;
        }
        $this->updateTotal();
    }

    public function updateTotal(){
        $this->totalQuantity = 0;
        foreach ($this->listProductAdded as $key => $value) {
            $this->totalQuantity += $value;
        }
        $this->totalAmount =  $this->totalQuantity*$this->product->product->retail_price;
    }

    public function addToCart(){
        if($this->totalQuantity == 0){
            session()->flash('error', 'Vui lòng chọn số lượng sản phẩm');
            return;
        }
        $cart = CartMD::where('user_id', Auth::user()->id)->first();
        if(!$cart){
            $cart = new CartMD();
            $cart->user_id = Auth::user()->id;
            $cart->save();
        }
        foreach ($this->listProductAdded as $key => $value) {
            if ($value > 0) {
                $cart_item = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $this->product_id)
                    ->where('product_detail_id', $this->product_detail_id)
                    ->where('warehouse_id', $this->warehouse_id)
                    ->where('size_id', $key)
                    ->first();
                if($cart_item){
                    $available_quantity = Warehouse::find($this->warehouse_id)->totalProductAvailable($this->product_id, $this->product_detail_id, $key);
                    if($this->mode == 'edit'){
                        $cart_item->quantity = $value;
                    }else{
                        $cart_item->quantity += $value;
                    }
                    if($cart_item->quantity > $available_quantity){
                        $this->dispatch('alertError', [$available_quantity]);
                        return;
                    }
                    $cart_item->total_amount = $cart_item->unit_price_at_time * $cart_item->quantity;
                    $cart_item->save();
                }else{
                    $cart_item = new CartItem();
                    $cart_item->cart_id = $cart->id;
                    $cart_item->product_id = $this->product_id;
                    $cart_item->product_detail_id = $this->product_detail_id;
                    $cart_item->warehouse_id = $this->warehouse_id;
                    $cart_item->size_id = $key;
                    $cart_item->unit_price_at_time = $this->product->product->retail_price;
                    $cart_item->quantity = $value;
                    $cart_item->total_amount = $this->product->product->retail_price * $value;
                    $cart_item->save();  
                }
            }
        }
        
        $cart_items = $cart->cart_item;
        $this->closeModalWithEvents([
            $this->dispatch('cartUpdated', $cart_items->count())
        ]);
    }
    public function render()
    {
        return view('livewire.client.modal-add-product-to-cart');
    }
}
