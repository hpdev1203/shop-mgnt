<?php

namespace App\Livewire\Admin\Arap;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\OrderDetail;
use App\Models\User;

class ListArap extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search_input = '';
    public $list_order = [];
    public $selected_index = [];
    public $list_user = [];
    public $year = "ALL";
    public $orders = [];
    public $YearSelect =  "ALL";
    public $customer = "ALL";
    public $user_choose = [];
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
    public function filterByYear()
    {
        $this->resetPage();
    }

    public function filterByCustomer()
    {
        $this->resetPage();
    }

    public function render()
    {
       
        if($this->year != "ALL"){
                $orders = Order::whereYear('order_date', $this->year)
                ->whereHas('orderStatus', function($query) {
                    $query->where('status', '!=', 'rejected')
                          ->orWhereNull('status');
                })->get();
        } else {
                $orders = Order::whereHas('orderStatus', function($query) {
                    $query->where('status', '!=', 'rejected')
                          ->orWhereNull('status');
                })->get();
        }
        $this->user_choose = User::where('role', 'customer')->get();
        if($this->search_input == ''){
                $users = User::where('role', 'customer')
                            ->when($this->customer != "ALL", function ($query) {
                                $query->where('id', $this->customer);
                            })
                             ->when($this->year != "ALL", function ($query) {
                                 $query->whereHas('orders', function ($subQuery) {
                                     $subQuery->whereYear('order_date', $this->year);
                                 });
                             })
                             ->paginate(10);
        }else{
                $users = User::where('role', '=', 'customer')
                            ->when($this->customer != "ALL", function ($query) {                        
                                $query->where('id', $this->customer);
                            })
                            ->where(function ($query) {
                                $query->where('name', 'like', '%'.$this->search_input.'%')->orWhere('code', 'like', '%'.$this->search_input.'%')->orWhere('phone', 'like', '%'.$this->search_input.'%');
                            })->when($this->year != "ALL", function ($subQuery) {
                                $subQuery->whereHas('orders', function ($subSubQuery) {
                                    $subSubQuery->whereYear('order_date', $this->year);
                                });
                        })->paginate(10);
        }
        $this->list_user = collect($users->items());
        $this->YearSelect = $this->year;
        return view('livewire.admin.arap.list-arap', ['orders' => $orders, 'users' => $users, 'YearSelect' => $this->year, 'user_choose' => $this->user_choose]);
    }
}
