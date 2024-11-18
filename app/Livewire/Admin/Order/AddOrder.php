<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Warehouse;
use Carbon\Carbon;

class AddOrder extends Component
{
    public $customers;
    public $payment_methods;
    public $order;
    public $order_details = [];
    public $order_code;
    public $payment_method_id = '';
    public $payment_status = '';
    public $customer_id = '';
    public $order_date = '';
    public $order_status = '';
    public $order_note = '';
    public $order_phone = '';
    public $order_email = '';
    public $order_address = '';
    public $order_state = '';
    public $order_city = '';
    public $subtotal_amount = 0;
    public $discount_amount = 0;
    public $grandtotal_amount = 0;
    public $shipping_amount = 0;
    public $total_amount = 0;
    public $grandtotal_notpay = 0;
    public $grandtotal_all = 0;
    public $discount_percentage = 0;   

    protected $listeners = ['updateOrderProduct'];

    public function mount($customers, $payment_methods)
    {
        $this->customers = $customers;
        $this->payment_methods = $payment_methods;
        $this->order_code = 'ODR' . time() . rand(100, 999) . rand(100, 999);
    }

    public function updateOrderProduct($order_product, $index = null)
    {
        if ($index === null) {
            $this->order_details[] = $order_product;
            $index = count($this->order_details) - 1;
        } else {
            $index = $index - 1;
            $this->order_details[$index] = $order_product;
        }
        $this->updateAmount($index);
        $this->calTotalAmount();
    }

    public function removeProduct($index)
    {
        unset($this->order_details[$index]);
        $this->updateAmount($index-1);
        $this->calTotalAmount();
    }

    public function createOrder(){
        $this->order_status = "pending";
        $this->storeOrder();
    }

    public function draftOrder(){
        $this->order_status = "draft";
        $this->storeOrder();
    }

    public function storeOrder()
    {
        $this->validateOrder();
        if(empty($this->order_details)){
            $this->dispatch('successOrder', [
                'title' => 'Thất bại',
                'message' => 'Vui lòng chọn sản phẩm cho đơn hàng',
                'type' => 'error',
                'timeout' => 3000
            ]);
            return;
        }
       
        $order = Order::create([
            'code' => $this->order_code,
            'user_id' => $this->customer_id,
            'payment_method_id' => $this->payment_method_id,
            'payment_status' => $this->payment_status,
            'order_date' => $this->order_date,
            'status' => $this->order_status,
            'note' => $this->order_note,
            'shipping_phone' => $this->order_phone,
            'shipping_email' => $this->order_email,
            'shipping_address' => $this->order_address,
            'shipping_state' => $this->order_state,
            'shipping_city' => $this->order_city,
            'subtotal_amount' => $this->subtotal_amount,
            'discount_amount' => $this->discount_amount,
            'grandtotal_amount' => $this->grandtotal_amount,
            'shipping_amount' => $this->shipping_amount,
            'total_amount' => $this->total_amount,
            'discount_percent' => $this->discount_percentage,
        ]);

        foreach ($this->order_details as $order_product) {
            if(empty($order_product["id"])){
                $order_detail = new OrderDetail();
            } else {
                $order_detail = OrderDetail::find($order_product["id"]);
            }
            $order_detail->fill([
                'order_id' => $order->id,
                'product_id' => $order_product["product_id"],
                'product_detail_id' => $order_product["product_detail_id"],
                'size_id' => $order_product["size_id"],
                'warehouse_id' => $order_product["warehouse_id"],
                'quantity' => $order_product["quantity"],
                'unit_price' => $order_product["unit_price"],
                'total_amount' => $order_product["total_amount"],
                'note' => $order_product["note"],
            ])->save();
        }

        $this->dispatch('successOrder', [
            'title' => 'Thành công',
            'message' => '',
            'type' => 'success',
            'timeout' => 3000
        ]);
    }

    protected function validateOrder()
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
    }

    public function updateAmount($index)
    {
        $this->subtotal_amount = 0;
        foreach ($this->order_details as $key => $order_product) {
            $this->subtotal_amount += $order_product["total_amount"];
        }
    }
    public function calTotalAmountDiscount()
    {
        if ($this->discount_percentage < 1 || $this->discount_percentage > 100) {
            $this->dispatch('successOrder', [
                'title' => 'Thất bại',
                'message' => 'Giảm giá % phải nằm trong khoảng từ 1 đến 100.',
                'type' => 'error',
                'timeout' => 3000
            ]);
            
            return;
        }
        $this->discount_amount = round($this->subtotal_amount * $this->discount_percentage / 100, 3);
        $this->grandtotal_amount = $this->subtotal_amount - $this->discount_amount;
        $this->total_amount = $this->grandtotal_amount + $this->shipping_amount;
        $this->grandtotal_all = $this->total_amount + $this->grandtotal_notpay;
    }
    public function calTotalAmount()
    {   
        $this->discount_amount = round($this->subtotal_amount * $this->discount_percentage / 100, 3);
        $this->grandtotal_amount = $this->subtotal_amount - $this->discount_amount;
        $this->total_amount = $this->grandtotal_amount + $this->shipping_amount;
        $this->grandtotal_all = $this->total_amount + $this->grandtotal_notpay;
    }

    protected function dispatchSuccessMessage($title, $message, $type)
    {
        $this->dispatch('successOrder', [
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'timeout' => 3000
        ]);
    }

    public function render()
    {
        $this->order_date = now()->format('Y-m-d');
        $grandtotal_notpay = Order::where('order_date', '<', now())->where('payment_status', '=', 'pending')
        ->whereHas('orderStatus', function($query) {
            $query->where('status', '!=', 'rejected')
                  ->orWhereNull('status');
        })->get();
        $this->grandtotal_notpay = $grandtotal_notpay->sum('total_amount');
        $this->grandtotal_all = $this->total_amount + $this->grandtotal_notpay;
    
        return view('livewire.admin.order.add-order');
    }
}
