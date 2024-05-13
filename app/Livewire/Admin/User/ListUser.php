<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\CartMD;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ContactUser;

class ListUser extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_user = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $user_id = $this->list_user[$key]['id'];
                $this->deleteUser($user_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deleteUser($id){
        $user = User::find($id);
        $orders = Order::where('user_id',$id)->get();
        if (count($orders) > 0) {
            foreach ($orders as $key => $order) {
                $order_details = OrderDetail::where('order_id', $order->id)->get();
                foreach ($order_details as $item) {
                    $item->delete();
                }
                $order->delete();
            }
        }

        $cart = CartMD::where('user_id',$id)->first();
        if (isset($cart)) {
            $cart_items = CartItem::where('cart_id', $cart->id)->get();
            foreach ($cart_items as $item) {
                $item->delete();
            }
            $cart->delete();
        }

        $contacts = ContactUser::where('user_id',$id)->get();
        if (count($contacts) > 0) {
            foreach ($contacts as $key => $contact) {
                $contact->delete();
            }
        }
        
        $user->delete();
        session()->flash('success', 'Khách hàng đã được xóa thành công');
    }

    public function handleDetele($id)
    {
        $this->deleteUser($id);
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $users = User::where('role','customer')->paginate(10);
        }else{
            $users = User::where('role', '=', 'customer')->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search_input.'%')->orWhere('email', 'like', '%'.$this->search_input.'%')->orWhere('phone', 'like', '%'.$this->search_input.'%');
            })->paginate(10);
        }
        $this->list_user = collect($users->items());
        return view('livewire.admin.user.list-user', ['users' => $users]);
    }
}
