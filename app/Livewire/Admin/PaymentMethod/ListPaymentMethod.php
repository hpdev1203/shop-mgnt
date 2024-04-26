<?php

namespace App\Livewire\Admin\PaymentMethod;

use Livewire\Component;
use App\Models\PaymentMethod;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListPaymentMethod extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_payment_method = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $payment_method_id = $this->list_payment_method[$key]['id'];
                $this->deletepayment_method($payment_method_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deletepayment_method($id){
        $payment_method = PaymentMethod::find($id);
        $payment_method->delete();
        session()->flash('success', 'payment_method deleted successfully');
    }

    public function handleDetele($id)
    {
        $this->deletepayment_method($id);
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $payment_methods = PaymentMethod::paginate(10);
        }else{
            $payment_methods = PaymentMethod::where('name', 'like', '%'.$this->search_input.'%')->orWhere('description', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $this->list_payment_method = collect($payment_methods->items());
        return view('livewire.admin.payment-method.list-payment-method',['payment_methods'=>$payment_methods]);
    }
}

