<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;

class Payment extends Component
{
    public $order_name = "";
    public $order_email = "";
    public $order_phone = "";
    public $order_code = "";
    public $order_address = "";
    public $order_state = "";
    public $order_city = "";
    public $order_payment_method = "";
    public $order_note = "";

    public function render()
    {
        $user = User::find(Auth::user()->id);
        $this->order_name = $user->name;
        $this->order_email = $user->email;
        $this->order_phone = $user->phone;
        $this->order_address = $user->address;
        $this->order_state = $user->state;
        $this->order_city = $user->city;
        $this->order_code = 'ODR' . time() . rand(100, 999) . rand(100, 999);
        $payment_methods = PaymentMethod::All();
        return view('livewire.client.payment',['payment_methods' => $payment_methods]);
    }
}
