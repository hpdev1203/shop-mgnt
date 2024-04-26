<?php

namespace App\Livewire\Admin\PaymentMethod;

use Livewire\Component;
use App\Models\PaymentMethod;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class EditPaymentMethod extends Component
{
    public $payment_method_code = '';
    public $payment_method_name = '';
    public $description = '';
    public $id;
    public $photo;
    public $existedPhoto;
    public $payment_method_active = '1';
    public $payment_method_default = '1';

    public function updatePaymentMethod()
    {
        $this->validate([
            'payment_method_code' => 'required|unique:payment_methods,code,' . $this->id,
            'payment_method_name' => 'required|unique:payment_methods,name,' . $this->id,
        ], [
            'payment_method_code.required' => 'Mã phương thức là bắt buộc.',
            'payment_method_code.unique' => 'Mã phương thức đã tồn tại.',
            'payment_method_name.required' => 'Tên phương thức là bắt buộc.',
            'payment_method_name.unique' => 'Tên phương thức đã tồn tại.',
        ]);
       
        $payment_method = PaymentMethod::find($this->id);
        $payment_method->code = $this->payment_method_code;
        $payment_method->name = $this->payment_method_name;
        $payment_method->description = $this->description;
        $payment_method->is_active = $this->payment_method_active;
        $payment_method->is_default = $this->payment_method_default;
        if($this->payment_method_default){
            PaymentMethod::where('is_default','=', '1')->update(['is_default'=>'0']);
        }
        


        $payment_method->save();

        session()->flash('message', 'payment_method has been updated successfully!');
        return redirect()->route('admin.payment-methods');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $payment_method = PaymentMethod::find($this->id);
        $this->payment_method_code = $payment_method->code;
        $this->payment_method_name = $payment_method->name;
        $this->description = $payment_method->description;
        $this->payment_method_active = $payment_method->is_active;
        $this->payment_method_default = $payment_method->is_default;

        return view('livewire.admin.payment-method.edit-payment-method',['payment_method' => $payment_method ]);
    }
}
