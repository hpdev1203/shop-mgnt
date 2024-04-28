<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;

class AddOrder extends Component
{
    public $payment_method;

    public function storeOrder()
    {
        dd($this->payment_method);
    }
    public function render()
    {
        return view('livewire.admin.order.add-order');
    }
}
