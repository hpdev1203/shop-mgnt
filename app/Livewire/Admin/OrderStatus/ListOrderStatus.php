<?php

namespace App\Livewire\Admin\OrderStatus;

use Livewire\Component;
use App\Models\OrderStatus;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListOrderStatus extends Component
{
    use WithPagination, WithoutUrlPagination; 
    public $search_input = '';
    public $order_status_list_collection;
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $id = $this->order_status_list_collection[$key]['id'];
                $this->deleteOrderStatus($id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteOrderStatus($id){
        $order_status = OrderStatus::find($id);
        $order_status->delete();
        session()->flash('success', 'Order status deleted successfully');
    }

    public function handleDetele($id)
    {
        $this->deleteOrderStatus($id);
        $this->render();
    }

    public function render()
    {
        if($this->search_input == ''){
            $order_status_list = OrderStatus::paginate(10);
        }else{
            $order_status_list = OrderStatus::where('name', 'like', '%'.$this->search_input.'%')->orWhere('description', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $this->order_status_list_collection = collect($order_status_list->items());
        return view('livewire.admin.order-status.list-order-status', ['order_status_list' => $order_status_list]);
    }
}
