<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Warehouse;

class AddOrder extends Component
{
    public $customers;
    public $payment_methods;
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
    public $order_products = [];
    public $product_list = [];
    public $product_model_list = [];
    public $product_size_list = [];
    public $products_id = [];
    public $warehouses = [];
    public $products_model_id = [];
    public $products_size_id = [];
    public $products_warehouse_id = [];
    public $products_quantity = [];
    public $products_unit_price = [];
    public $products_total_price = [];
    public $discount = 0;
    public $total_price = 0;

    protected $listeners = ['updateOrderProduct'];

    public function storeOrder()
    {
        $this->validate([
            'customer_id' => 'required',
            'payment_method_id' => 'required',
            'payment_status' => 'required',
            'order_date' => 'required',
            'order_status' => 'required',
            'order_code' => 'required',
            'order_phone' => 'required',
            'order_address' => 'required',
            'order_state' => 'required',
            'order_city' => 'required'
        ]);

        $order = new Order();
        $order->user_id = $this->customer_id;
        $order->payment_method_id = $this->payment_method_id;
        $order->payment_status = $this->payment_status;
        $order->order_date = $this->order_date;
        $order->status = $this->order_status;
        $order->note = $this->order_note;
        $order->code = $this->order_code;
        $order->shipping_phone = $this->order_phone;
        $order->shipping_address = $this->order_address;
        $order->shipping_state = $this->order_state;
        $order->shipping_city = $this->order_city;
        $order->discount = $this->discount;
        $order->total_price = $this->total_price;

        foreach ($this->order_products as $order_product) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $order_product['product_id'];
            $order_detail->product_detail_id = $order_product['product_detail_id'];
            $order_detail->product_size_id = $order_product['product_size_id'];
            $order_detail->warehouse_id = $order_product['warehouse_id'];
            $order_detail->quantity = $order_product['quantity'];
            $order_detail->unit_price = $order_product['unit_price'];
            $order_detail->total_price = $order_product['total_price'];
            order_detail->save();

            $order->order_details()->create([
                'product_id' => $order_product['product_id'],
                'product_detail_id' => $order_product['product_detail_id'],
                'product_size_id' => $order_product['product_size_id'],
                'warehouse_id' => $order_product['warehouse_id'],
                'quantity' => $order_product['quantity'],
                'unit_price' => $order_product['unit_price'],
                'total_price' => $order_product['total_price'],
            ]);
        }

        $this->reset();
        session()->flash('message', '');

    }

    public function loadProductAttributes($index)
    {
        $this->product_model_list[$index] = ProductDetail::where('product_id', $this->products_id[$index])->get();
        $this->product_size_list[$index] = ProductSize::where('product_id', $this->products_id[$index])->get();
        $this->products_quantity[$index] = 1;
        $this->products_unit_price[$index] = Product::find($this->products_id[$index])->retail_price;
        $this->updateAmount($index);
    }

    public function updateAmount($index)
    {
        $this->total_price = 0;
        $this->products_total_price[$index] = $this->products_quantity[$index] * $this->products_unit_price[$index];
        foreach ($this->order_products as $key => $order_product) {
            $this->total_price += $this->products_total_price[$key];
        }
    }

    public function mount($customers, $payment_methods, $products)
    {
        $this->customers = $customers;
        $this->payment_methods = $payment_methods;
        $this->product_list = Product::all();
        $this->order_products = collect(new OrderDetail);
        $this->warehouses = Warehouse::all();
        $this->order_code = 'ODR'.rand(100,999).time().rand(100,999);
    }

    public function addProduct()
    {
        $new_order_product = new OrderDetail();
        $this->order_products->push($new_order_product);
    }

    public function render()
    {
        return view('livewire.admin.order.add-order', [
            'customers' => $this->customers,
            'payment_methods' => $this->payment_methods
        ]);
    }
}
