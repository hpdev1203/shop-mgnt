<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\OrderDetail;

class ListOrder extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search_input = '';
    public $list_order = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $order_id = $this->list_order[$key]['id'];
                $this->deleteOrder($order_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteOrder($id){
        $order_detail = OrderDetail::where('order_id', $id)->get();
        foreach ($order_detail as $item) {
            $item->delete();
        }
        $order = Order::find($id);
        $order->delete();
        session()->flash('success', 'Order deleted successfully');
    }

    public function handleDetele($id)
    {
        $this->deleteOrder($id);
        $this->render();
    }

    public function render()
    {
        if($this->search_input == ''){
            $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $orders = Order::where('code', 'like', '%'.$this->search_input.'%')->orderBy('created_at', 'desc')->paginate(10);
        }
        $this->list_order = collect($orders->items());
        return view('livewire.admin.order.list-order', ['orders' => $orders]);
    }
}
