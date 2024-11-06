<?php

namespace App\Livewire\Admin\Arap;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\OrderDetail;
use App\Models\User;
class ViewArap extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search_input = '';
    public $list_order = [];
    public $selected_index = [];
    public $id = '';
    public $year = 'ALL';

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
    public function filterByYear()
    {
        $this->resetPage();
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

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $user = User::find($this->id);
        if($this->search_input == ''){
            $orders = Order::where('user_id', '=', $this->id)->when($this->year != "ALL", function ($query) {
                $query->whereYear('order_date', $this->year);
            })->paginate(10);
           
        } else {
            $orders = Order::where('user_id', '=', $this->id)->where('code', 'like', '%'.$this->search_input.'%')->when($this->year != "ALL", function ($query) {
                $query->whereYear('order_date', $this->year);
            })->paginate(10);
        }
        
        $this->list_order = collect($orders->items());
        return view('livewire.admin.arap.view-arap', ['orders' => $orders, 'year' => $this->year, 'user' => $user]);
    }
}
