<?php

namespace App\Livewire\Admin\PaymentMethod;

use Livewire\Component;
use App\Models\PaymentMethod;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class AddPaymentMethod extends Component
{
    use WithFileUploads;

    public $payment_method_code = '';
    public $payment_method_name = '';
    public $description = '';
    public $payment_method_active = '1';
    public $payment_method_default = '1';

    public function storePaymentMethod()
    {
        $this->validate([
            'payment_method_code' => 'required|unique:payment_methods,code',
            'payment_method_name' => 'required|unique:payment_methods,name',
        ], [
            'payment_method_code.required' => 'Mã Phương Thức là bắt buộc.',
            'payment_method_code.unique' => 'Mã Phương Thức đã tồn tại.',
            'payment_method_name.required' => 'Tên Phương Thức là bắt buộc.',
            'payment_method_name.unique' => 'Tên Phương Thức đã tồn tại.',
        ]);
     
        $payment_method = new PaymentMethod();
        $payment_method->code = $this->payment_method_code;
        $payment_method->name = $this->payment_method_name;
        $payment_method->description = $this->description;
        $payment_method->is_active = $this->payment_method_active;
        $payment_method->is_default = $this->payment_method_default;
        if($this->payment_method_default){
            PaymentMethod::where('is_default','=', '1')->update(['is_default'=>'0']);
        }

        $payment_method->save();

        session()->flash('message', 'Payment Method has been created successfully!');
        return redirect()->route('admin.payment-methods');
    }
    public function render()
    {
        $payment_methods = PaymentMethod::all();
        return view('livewire.admin.payment-method.add-payment-method', ['payment_methods' => $payment_methods]);
    }
}
