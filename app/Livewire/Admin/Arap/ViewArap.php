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
    public $month = 'ALL';

    public function search()
    {
        $this->resetPage();
    }


    public function filterByYear()
    {
        $this->resetPage();
    }
    public function filterByMonth()
    {
        $this->resetPage();
    }   

    public function updateOrder($id){
        $order_detail = OrderDetail::where('order_id', $id)->get();
        foreach ($order_detail as $item) {
            $item->delete();
        }
        $order = Order::find($id);
        $order->payment_status = 'paid';
        $order->save();
        
    }

    public function paySelectedOrders()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $order_id = $this->list_order[$key]['id'];
                $this->updateOrder($order_id);
            }
        }
        $this->selected_index = [];
        session()->flash('success', 'Order updated successfully');
        $this->render();
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
    function toggleSelectAll()
    {
        $this->selected_index = $this->list_order->pluck('id')->toArray();
        
        $this->render();    
    }   

    public function render()
    {
        $user = User::find($this->id);
        if($this->search_input == ''){
            $orders = Order::where('user_id', '=', $this->id)->when($this->year != "ALL", function ($query) {
                $query->whereYear('order_date', $this->year);
            })
            ->where('status', '!=', 'rejected')
            ->when($this->month != "ALL", function ($query) {
                $query->whereMonth('order_date', $this->month);
            })
            ->whereHas('orderStatus', function($query) {
                $query->where('status', '!=', 'rejected')
                      ->orWhereNull('status');
            })
            ->orderBy('order_date', 'desc')
            ->paginate(1000);
           
        } else {
            $orders = Order::where('user_id', '=', $this->id)->where('code', 'like', '%'.$this->search_input.'%')->when($this->year != "ALL", function ($query) {
                $query->whereYear('order_date', $this->year);
            })
            ->when($this->month != "ALL", function ($query) {
                $query->whereMonth('order_date', $this->month);
            })
            ->where('status', '!=', 'rejected')
            ->whereHas('orderStatus', function($query) {
                $query->where('status', '!=', 'rejected')
                      ->orWhereNull('status');
            })
            ->orderBy('order_date', 'desc')
            ->paginate(1000);
        }
        foreach ($orders as $index => $order) {
            $this->selected_index[$index] = false;
        }
        $this->list_order = collect($orders->items());
        return view('livewire.admin.arap.view-arap', ['orders' => $orders, 'year' => $this->year, 'user' => $user]);
    }
}
