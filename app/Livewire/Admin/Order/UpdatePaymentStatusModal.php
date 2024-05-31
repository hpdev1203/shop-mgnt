<?php

namespace App\Livewire\Admin\Order;

use LivewireUI\Modal\ModalComponent;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;

class UpdatePaymentStatusModal extends ModalComponent
{
    public $title_status;
    public $note;
    public $order_id;
    public $payment_status = '';
    public function mount($order_id, $payment_status)
    {
        $this->order_id = $order_id;
        $this->payment_status = $payment_status;
    }

    public function updateStatus(){
        $order = Order::find($this->order_id);
        $order->payment_status = $this->payment_status;
        $order->save();

        $order_status = new OrderStatus();
        $order_status->order_id = $this->order_id;
        $order_status->status = $this->payment_status;
        $order_status->note = $this->note;
        $order_status->action_by = Auth::user()->id;
        $order_status->save();

        $this->redirectRoute('admin.orders');
    }
    public function render()
    {
        return view('livewire.admin.order.update-payment-status-modal');
    }
}
