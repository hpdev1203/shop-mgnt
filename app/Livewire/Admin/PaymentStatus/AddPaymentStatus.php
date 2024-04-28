<?php

namespace App\Livewire\Admin\PaymentStatus;

use Livewire\Component;
use App\Models\PaymentStatus;

class AddPaymentStatus extends Component
{
    public $payment_status_code = "";
    public $payment_status_name = "";
    public $payment_status_stt = "";
    public $payment_status_color = "#ffffff";
    public $payment_status_icon = "";
    public $payment_status_desc = "";
    public $payment_status_active = 1;
    public $payment_status_default = 0;

    public function storePaymentStatus()
    {
        dd($this->payment_status_icon);
        $this->validate([
            'payment_status_code' => 'required|unique:import_product,code',
            'payment_status_name' => 'required',
            'payment_status_stt' => 'required',
        ], [
            'payment_status_code.required' => 'Vui lòng nhập mã trạng thái.',
            'payment_status_code.unique' => 'Mã trạng thái đã tồn tại.',
            'payment_status_name.required' => 'Vui lòng nhập tiêu đề.',
            'payment_status_stt.required' => 'Vui lòng nhập số thứ tự.',
        ]);

        $payment_status = new PaymentStatus();
        $payment_status->code = $this->payment_status_code;
        $payment_status->name = $this->payment_status_name;
        $payment_status->sort_order = $this->payment_status_stt;
        $payment_status->color = $this->payment_status_color;
        $payment_status->icon = $this->payment_status_icon;
        $payment_status->description = $this->payment_status_desc;
        if($this->payment_status_active == false){
            $this->payment_status_active = 0;
        }else{
            $this->payment_status_active = 1;
        }
        $payment_status->is_active = $this->payment_status_active;
        if($this->payment_status_default == false){
            $this->payment_status_default = 0;
        }else{
            $this->payment_status_default = 1;
        }
        if($this->payment_status_active == 0){
            $this->payment_status_default = 0;
        }
        $payment_status->is_default = $this->payment_status_default;
        $payment_status->save();
        if($this->payment_status_default == 1){
            $payment_status_others = PaymentStatus::where('id','<>',$payment_status->id)->get();
            if (count($payment_status_others) > 0) {
                foreach ($payment_status_others as $key => $payment_status_other) {
                    $payment_status_other->is_default = 0;
                    $payment_status_other->save();
                }
            }
        }
        return redirect()->route('admin.payment-status');
    }

    public function render()
    {
        $payment_status = PaymentStatus::all();
        if(count($payment_status) == 0){
            $this->payment_status_default = 1;
        }
        $this->payment_status_code = 'PAY-'.str_pad(count($payment_status) + 1, 4, '0', STR_PAD_LEFT);
        return view('livewire.admin.payment-status.add-payment-status');
    }
}
