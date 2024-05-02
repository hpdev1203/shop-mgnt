<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\ProductDetail;
use App\Models\OrderDetail;
use App\Models\ProductSize;
use App\Models\Warehouse;

class OrderDetailModal extends ModalComponent
{
    public $products;
    public $product_details;
    public $product_id;
    public $product_detail_id;
    public $product_size_id;
    public $product_sizes;
    public $product_quantity = 0;
    public $warehouses;

   

    public function mount($products)
    {
        $this->products = $products;
        $this->product_details = collect(new ProductDetail);
        $this->product_sizes = collect(new ProductSize);
        $this->warehouses = Warehouse::all();
    }

    public function loadProductDetails()
    {
        $this->product_details = ProductDetail::where('product_id', $this->product_id)->get();
        $this->product_sizes = ProductSize::where('product_id', $this->product_id)->get();
        $this->product_detail_id = '';
        $this->product_size_id = '';
        $this->dispatch('loadProductDetails', ['product_details' => $this->product_details, 'product_sizes' => $this->product_sizes]);
    }

    public function storeOrderProduct(){
        $order_product = new OrderDetail();
        $order_product->product_id = $this->product_id;
        $order_product->product_detail_id = $this->product_detail_id;
        $this->closeModalWithEvents([
            AddOrder::class => ['updateOrderProduct', [$order_product]],
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.admin.order.order-detail-modal');
    }
}
