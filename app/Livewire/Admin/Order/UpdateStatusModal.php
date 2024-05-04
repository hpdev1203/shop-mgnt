<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\Auth;

class UpdateStatusModal extends ModalComponent
{
    public $title_status;
    public $note;
    public $order_id;
    public $status;

    public function mount($order_id, $status)
    {
        $this->order_id = $order_id;
        $this->status = $status;
        switch ($status) {
            case 'confirmed':
                $this->title_status = 'Xác nhận đơn hàng';
                break;
            case 'shipping':
                $this->title_status = 'Xác nhận đang giao hàng';
                break;
            case 'delivered':
                $this->title_status = 'Xác nhận đã giao hàng';
                break;
            case 'completed':
                $this->title_status = 'Xác nhận hoàn thành đơn hàng';
                break;
            case 'rejected':
                $this->title_status = 'Xác nhận từ chối đơn hàng';
                break;
            default:
                $this->title_status = 'Xác nhận đơn hàng';
                break;
        }
    }

    public function updateStatus(){
        $order = Order::find($this->order_id);
        $order->status = $this->status;
        $order->save();

        $order_status = new OrderStatus();
        $order_status->order_id = $this->order_id;
        $order_status->status = $this->status;
        $order_status->note = $this->note;
        $order_status->action_by = Auth::user()->id;
        $order_status->save();

        $this->redirectRoute('admin.orders');
    }

    public function render()
    {
        return view('livewire.admin.order.update-status-modal');
    }
}
