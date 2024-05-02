<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
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
    public $order_email = '';
    public $order_address = '';
    public $order_state = '';
    public $order_city = '';
    public $order_details = [];
    public $subtotal_amount = 0;
    public $discount_amount = 0;
    public $grandtotal_amount = 0;
    public $shipping_amount = 0;
    public $total_amount = 0;

    protected $listeners = ['updateOrderProduct'];

    public function updateOrderProduct($order_product, $index)
    {
        if($index == null){
            $this->order_details->push($order_product);
            $index = $this->order_details->count() - 1;
        }else{
            $this->order_details[$index-1] = $order_product;
        }
        $this->updateAmount($index-1);
        $this->calTotalAmount();
    }

    public function removeProduct($index)
    {
        $this->order_details->forget($index);
        $this->order_details = $this->order_details->values();
        $this->updateAmount(count($this->order_details)-1);
        $this->calTotalAmount();
    }

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
        ], [
            'customer_id.required' => 'Trường khách hàng là bắt buộc.',
            'payment_method_id.required' => 'Trường phương thức thanh toán là bắt buộc.',
            'payment_status.required' => 'Trường trạng thái thanh toán là bắt buộc.',
            'order_date.required' => 'Trường ngày đặt hàng là bắt buộc.',
            'order_status.required' => 'Trường trạng thái đơn hàng là bắt buộc.',
            'order_code.required' => 'Trường mã đơn hàng là bắt buộc.',
            'order_phone.required' => 'Trường số điện thoại đơn hàng là bắt buộc.',
            'order_address.required' => 'Trường địa chỉ đơn hàng là bắt buộc.',
            'order_state.required' => 'Trường tỉnh/thành phố đơn hàng là bắt buộc.',
            'order_city.required' => 'Trường quận/huyện đơn hàng là bắt buộc.'
        ]);

        if(count($this->order_details) == 0){
            $this->dispatch('successOrder', [
                'title' => 'Thêm đơn hàng thất bại',
                'message' => 'Vui lòng chọn sản phẩm cho đơn hàng',
                'type' => 'error',
                'timeout' => 3000
            ]);
            return;
        }

        $order = new Order();
        $order->code = $this->order_code;
        $order->user_id = $this->customer_id;
        $order->order_date = $this->order_date;
        $order->shipping_address = $this->order_address;
        $order->shipping_phone = $this->order_phone;
        $order->shipping_email = $this->order_email;
        $order->shipping_state = $this->order_state;
        $order->shipping_city = $this->order_city;
        $order->payment_method_id = $this->payment_method_id;
        $order->payment_status = $this->payment_status;
        $order->status = $this->order_status;
        $order->note = $this->order_note;
        $order->subtotal_amount = $this->subtotal_amount;
        $order->shipping_amount = $this->shipping_amount;
        $order->discount_amount = $this->discount_amount;
        $order->grandtotal_amount = $this->grandtotal_amount;
        $order->total_amount = $this->total_amount;
        $order->save();

        foreach ($this->order_details as $key => $order_product) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $order_product["product_id"];
            $order_detail->product_detail_id = $order_product["product_detail_id"];
            $order_detail->size_id = $order_product["size_id"];
            $order_detail->warehouse_id = $order_product["warehouse_id"];
            $order_detail->quantity = $order_product["quantity"];
            $order_detail->unit_price = $order_product["unit_price"];
            $order_detail->total_amount = $order_product["total_amount"];
            $order_detail->note = $order_product["note"];
            $order_detail->save();
        }

        $this->dispatch('successOrder', [
            'title' => 'Thêm đơn hàng thành công',
            'message' => '',
            'type' => 'success',
            'timeout' => 3000
        ]);

    }

    public function updateAmount($index)
    {
        $this->subtotal_amount = 0;
        foreach ($this->order_details as $key => $order_product) {
            $this->subtotal_amount += $order_product["total_amount"];
        }
    }

    public function calTotalAmount()
    {
        $this->grandtotal_amount = $this->subtotal_amount - $this->discount_amount;
        $this->total_amount = $this->grandtotal_amount + $this->shipping_amount;
    }

    public function mount($customers, $payment_methods, $products)
    {
        $this->customers = $customers;
        $this->payment_methods = $payment_methods;
        $this->product_list = Product::all();
        $this->order_details = collect(new OrderDetail);
        $this->warehouses = Warehouse::all();
        $this->order_code = 'ODR'.time().rand(100,999).rand(100,999);
    }

    public function render()
    {
        return view('livewire.admin.order.add-order', [
            'customers' => $this->customers,
            'payment_methods' => $this->payment_methods
        ]);
    }
}
