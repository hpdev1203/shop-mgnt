<?php

namespace App\Livewire\Admin\PaymentStatus;

use Livewire\Component;
use App\Models\PaymentStatus;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ListPaymentStatus extends Component
{
    use WithPagination, WithoutUrlPagination; 

    public $search_input = '';
    public $list_payment_status = [];
    public $selected_index = [];

    public function search()
    {
        $this->resetPage();
    }

    public function deleteListCheckbox()
    {
        foreach ($this->selected_index as $key => $checked) {
            if($checked == true){
                $payment_status_id = $this->list_payment_status[$key]['id'];
                $this->deletePaymentStatus($payment_status_id);
            }
        }
        $this->selected_index = [];
        $this->render();
    }

    public function deletePaymentStatus($id){
        $payment_status = PaymentStatus::find($id);
        $payment_status->delete();
    }

    public function handleDetele($id)
    {
        $this->deletePaymentStatus($id);
        $this->render();
    }
    
    public function render()
    {
        if($this->search_input == ''){
            $payment_status = PaymentStatus::paginate(10);
        }else{
            $payment_status = PaymentStatus::where('name', 'like', '%'.$this->search_input.'%')->orWhere('description', 'like', '%'.$this->search_input.'%')->paginate(10);
        }
        $this->list_payment_status = collect($payment_status->items());
        return view('livewire.admin.payment-status.list-payment-status', ['payment_status' => $payment_status]);
    }
}
