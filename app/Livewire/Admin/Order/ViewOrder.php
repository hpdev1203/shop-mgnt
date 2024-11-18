<?php

namespace App\Livewire\Admin\Order;

use App\Models\PaymentMethod;
use Livewire\Component;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class ViewOrder extends Component
{
    public $customers;
    public $payment_methods;
    public $payment_method_id = '';
    public $payment_method_name = '';
    public $payment_status = '';
    public $customer_id = '';
    public $customer_name ='';
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
    public $discount_percent = 0;
    public $order;
    public $order_id;
    public $order_product_delete = [];
    public $grandtotal_notpay = 0;
    public $grandtotal_all = 0;

    protected $listeners = ['updateOrderProduct'];

    public function updateOrderProduct($order_product, $index = null)
    {
        if($index === null){
            $this->order_details[] = $order_product;
            $index = count($this->order_details) - 1;
        } else {
            $index = $index - 1;
            if(empty($this->order_details[$index]["id"])){
                $id = null;
            } else {
                $id = $this->order_details[$index]["id"];
            }
            
            $this->order_details[$index] = $order_product;
            $this->order_details[$index]["id"] = $id;
        }
        $this->updateAmount($index);
        $this->calTotalAmount();
    }
    public function generatePDF()
    {
        $data = ['title' => 'TEST'];
        $pdf = PDF::loadView('admin.dashboard.order.pdf_view', $data);
        $pdf->setPaper('A4', 'portrait');


        $pdf->set_option('defaultFont', 'DejaVuSans');
        return $pdf->download('laravel_pdf.pdf');
    }

    public function removeProduct($index)
    {
        $this->order_product_delete[] = $this->order_details[$index];
        unset($this->order_details[$index]);
        $this->order_details = array_values($this->order_details);
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

        $this->order->update([
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
            'discount_percent' => $this->discount_percent,
        ]);

        foreach ($this->order_product_delete as $order_product) {
            OrderDetail::find($order_product["id"])->delete();
        }
        foreach ($this->order_details as $order_product) {
            if(empty($order_product["id"])){
                $order_detail = new OrderDetail();
            } else {
                $order_detail = OrderDetail::find($order_product["id"]);
            }
            $order_detail->fill([
                'order_id' => $this->order->id,
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

    public function calTotalAmount()
    {
        $this->grandtotal_amount = $this->subtotal_amount - $this->discount_amount;
        $this->total_amount = $this->grandtotal_amount + $this->shipping_amount;
    }

    public function mount($id, $customers, $payment_methods)
    {
        $this->order = Order::findOrFail($id);
        $this->order_id = $id;
        $this->payment_method_id = $this->order->payment_method_id;
        $this->payment_method_name = PaymentMethod::find($this->payment_method_id)->name;
        $this->payment_status = $this->order->payment_status;
        $this->customer_id = $this->order->user_id;
        $this->customer_name = User::find($this->customer_id)->name;
        $this->order_date = date('Y-m-d', strtotime($this->order->order_date));
        $this->order_status = $this->order->status;
        $this->order_note = $this->order->note;
        $this->order_code = $this->order->code;
        $this->order_phone = $this->order->shipping_phone;
        $this->order_email = $this->order->shipping_email;
        $this->order_address = $this->order->shipping_address;
        $this->order_state = $this->order->shipping_state;
        $this->order_city = $this->order->shipping_city;
        $this->subtotal_amount = $this->order->subtotal_amount;
        $this->discount_amount = $this->order->discount_amount;
        $this->grandtotal_amount = $this->order->grandtotal_amount;
        $this->shipping_amount = $this->order->shipping_amount;
        $this->total_amount = $this->order->total_amount;
        $this->customers = $customers;
        $this->payment_methods = $payment_methods;
        $this->discount_percent = $this->order->discount_percent;
        $this->order_details = $this->order->order_detail()->with('product', 'product_size', 'warehouse', 'product_detail')->get()->toArray();

        $grandtotal_notpay = Order::where('user_id', '=', $this->customer_id)->where('id', '<>', $id)->where('order_date', '<', now())->where('payment_status', '=', 'pending')
        ->whereHas('orderStatus', function($query) {
            $query->where('status', '!=', 'rejected')
                  ->orWhereNull('status');
        })->get();
        $this->grandtotal_notpay = $grandtotal_notpay->sum('total_amount');
        $this->grandtotal_all = $this->total_amount + $this->grandtotal_notpay; 
    }

    public function render()
    {
        return view('livewire.admin.order.view-order');
    }
}
