<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use Livewire\Component;

class AddOrder extends Component
{
    public $customers;
    public $payment_methods;
    public $products;
    public $payment_method_id = '';
    public $payment_status = '';
    public $customer_id = '';
    public $order_date = '';
    public $order_status = '';
    public $order_note = '';
    public $order_code = '';
    public $order_phone = '';
    public $order_address = '';
    public $order_state = '';
    public $order_city = '';
    public $order_total = 0;
    public $order_total_paid = 0;
    public $order_products;
    public $product_add = '';
    public $product_details;
    public $product_detail;


    public function storeOrder()
    {
        dd($this->payment_method_id);
    }

    public function mount($customers, $payment_methods, $products)
    {
        $this->customers = $customers;
        $this->payment_methods = $payment_methods;
        $this->products = $products;
        $this->order_products = collect(new OrderDetail);
    }

    public function render()
    {
        $this->product_details = ProductDetail::where('product_id', $this->product_add)->get();
        return view('livewire.admin.order.add-order', [
            'customers' => $this->customers,
            'payment_methods' => $this->payment_methods
        ]);
    }
}
