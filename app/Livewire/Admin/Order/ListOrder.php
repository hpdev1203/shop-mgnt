<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use App\Models\Order;

class ListOrder extends Component
{
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
            $orders = Order::paginate(10);
        } else {
            $orders = Order::where('name', 'like', '%'.$this->search_input.'%')->orWhere('code', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        return view('livewire.admin.order.list-order', ['orders' => $orders]);
    }
}
