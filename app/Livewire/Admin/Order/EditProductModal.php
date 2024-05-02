<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\ProductDetail;
use App\Models\OrderDetail;
use App\Models\ProductSize;
use App\Models\Warehouse;
use App\Models\Product;

class EditProductModal extends ModalComponent
{
    public $products;
    public $product_details;
    public $product_sizes;
    public $warehouses;
    public $product_id;
    public $product_detail_id;
    public $product_size_id;
    public $product_quantity = 0;
    public $product_unit_price = 0;
    public $product_total_amount = 0;
    public $note = '';
    public $warehouse_id;
    public $order_product;
    public $index;
    public $classRef;
    public function mount($order_detail, $index, $mode)
    {
        if($mode == 'edit'){
            $this->classRef = AddOrder::class;
        }else{
            $this->classRef = EditOrder::class;
        }
        $this->order_product = $order_detail;
        $this->index = $index+1;
        $this->product_id = $this->order_product["product_id"];
        $this->product_detail_id = $this->order_product["product_detail_id"];
        $this->product_size_id = $this->order_product["size_id"];
        $this->product_quantity = $this->order_product["quantity"];
        $this->product_unit_price = $this->order_product["unit_price"];
        $this->product_total_amount = $this->order_product["total_amount"];
        $this->note = $this->order_product["note"];
        $this->warehouse_id = $this->order_product["warehouse_id"];
        $this->order_product = new OrderDetail();

        $this->products = Product::all();
        $this->product_details = ProductDetail::where('product_id', $this->product_id)->get();
        $this->product_sizes = ProductSize::where('product_id', $this->product_id)->get();
        $this->warehouses = Warehouse::all();
    }

    public function loadProductAttributes()
    {
        $this->product_details = ProductDetail::where('product_id', $this->product_id)->get();
        $this->product_sizes = ProductSize::where('product_id', $this->product_id)->get();
        $this->product_unit_price = Product::where('id', $this->product_id)->first()->retail_price;
        $this->product_detail_id = '';
        $this->product_size_id = '';
    }

    public function updateAmount()
    {
        $this->product_total_amount = $this->product_quantity * $this->product_unit_price;
    }

    public function storeOrderProduct(){
        $this->order_product->product_id = $this->product_id;
        $this->order_product->product_detail_id = $this->product_detail_id;
        $this->order_product->product_name = $this->order_product->product->name;
        $this->order_product->product_detail_name = $this->order_product->product_detail->title;
        $this->order_product->size_id = $this->product_size_id;
        $this->order_product->size_name = $this->order_product->product_size->size;
        $this->order_product->warehouse_id = $this->warehouse_id;
        $this->order_product->warehouse_name = $this->order_product->warehouse->name;
        $this->order_product->quantity = $this->product_quantity;
        $this->order_product->unit_price = $this->product_unit_price;
        $this->order_product->total_amount = $this->product_total_amount;
        $this->order_product->note = $this->note;
        $this->closeModalWithEvents([
            $this->classRef => ['updateOrderProduct', [$this->order_product, $this->index]],
        ]);
    }

    public function debug()
    {
       dd($this->order_product, $this->index);
    }
    public function render()
    {
        return view('livewire.admin.order.edit-product-modal');
    }
}
