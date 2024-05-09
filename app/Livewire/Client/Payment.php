<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;
use App\Models\CartMD;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;


class Payment extends Component
{
    public $order_name = "";
    public $order_email = "";
    public $order_phone = "";
    public $order_code = "";
    public $order_address = "";
    public $order_state = "";
    public $order_city = "";
    public $order_payment_method = "";
    public $order_note = "";
    public $subtotal_amount = 0;
    public $discount_amount = 0;
    public $grandtotal_amount = 0;
    public $shipping_amount = 0;
    public $total_amount = 0;

    public function payment(){
        $cart_items = CartItem::select(
            'cart_item.product_id',
            'cart_item.product_detail_id',
            'cart_item.warehouse_id',
            'cart_item.size_id',
            'cart_item.quantity',
            'cart_item.unit_price_at_time',
            'cart_item.total_amount'
        )
        ->join('cart','cart_item.cart_id','=','cart.id')
        ->where('cart.user_id',Auth::user()->id)->get();

        $this->validate([
            'order_name' => 'required',
            'order_email' => 'required|email',
            'order_phone' => 'required',
            'order_address' => 'required',
            'order_state' => 'required',
            'order_city' => 'required',
            'order_payment_method' => 'required',
        ], [
            'order_name.required' => 'Vui lòng nhập tên.',
            'order_email.required' => 'Vui lòng nhập email.',
            'order_email.email' => 'Email không đúng định dạng.',
            'order_phone.required' => 'Vui lòng nhập số điện thoại.',
            'order_address.required' => 'Vui lòng nhập địa chỉ.',
            'order_state.required' => 'Vui lòng nhập Quận/Huyện.',
            'order_city.required' => 'Vui lòng nhập Tỉnh/Thành phố.',
            'order_payment_method.required' => 'Vui lòng chọn hình thức thanh toán.',
        ]);
        
        if (count($cart_items) == 0) {
            $this->dispatch('successPayment', [
                'title' => 'Thất bại',
                'message' => 'Vui lòng chọn sản phẩm cho đơn hàng',
                'type' => 'error'
            ]);
            return;
        }

        $this->subtotal_amount = 0;
        foreach ($cart_items as $key => $cart_item) {
            $this->subtotal_amount += $cart_item->total_amount;
        }
        $this->grandtotal_amount = $this->subtotal_amount - $this->discount_amount;
        $this->total_amount = $this->grandtotal_amount + $this->shipping_amount;

        $order = Order::create([
            'code' => $this->order_code,
            'user_id' => Auth::user()->id,
            'shipping_address' => $this->order_address,
            'shipping_phone' => $this->order_phone,
            'shipping_email' => $this->order_email,
            'payment_status' => 'pending',
            'status' => 'pending',
            'subtotal_amount' => $this->subtotal_amount,
            'shipping_amount' => $this->shipping_amount,
            'discount_amount' => $this->discount_amount,
            'grandtotal_amount' => $this->grandtotal_amount,
            'total_amount' => $this->total_amount,
            'note' => $this->order_note,
            'order_date' => now(),
            'shipping_state' => $this->order_state,
            'shipping_city' => $this->order_city,
            'payment_method_id' => $this->order_payment_method,
        ]);

        foreach ($cart_items as $key => $cart_item) {
            $order_detail = new OrderDetail();
            $order_detail->fill([
                'order_id' => $order->id,
                'product_id' => $cart_item->product_id,
                'product_detail_id' => $cart_item->product_detail_id,
                'size_id' => $cart_item->size_id,
                'warehouse_id' => $cart_item->warehouse_id,
                'quantity' => $cart_item->quantity,
                'unit_price' => $cart_item->unit_price_at_time,
                'total_amount' => $cart_item->total_amount,
            ])->save();
        }

        $carts = CartMD::where('user_id',Auth::user()->id)->first();
        $this->deleteCart($carts->id);

        $this->dispatch('successPayment', [
            'title' => 'Thành công',
            'message' => 'Đã đặt thành công đơn hàng '.$order->code,
            'type' => 'success'
        ]);
    }

    public function deleteCart($id){
        $cart_items = CartItem::where('cart_id', $id)->get();
        foreach ($cart_items as $item) {
            $item->delete();
        }
        $carts = CartMD::find($id);
        $carts->delete();
    }

    public function render()
    {
        $user = User::find(Auth::user()->id);
        $this->order_name = $user->name;
        $this->order_email = $user->email;
        $this->order_phone = $user->phone;
        $this->order_address = $user->address;
        $this->order_state = $user->state;
        $this->order_city = $user->city;
        $this->order_code = 'ODR' . time() . rand(100, 999) . rand(100, 999);
        $payment_methods = PaymentMethod::All();
        return view('livewire.client.payment',['payment_methods' => $payment_methods]);
    }
}
