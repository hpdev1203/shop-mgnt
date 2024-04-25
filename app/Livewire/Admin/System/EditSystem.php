<?php

namespace App\Livewire\Admin\System;

use Livewire\Component;
use App\Models\System;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class EditSystem extends Component
{
    use WithFileUploads;

    public $system_name = '';
    public $system_email = '';
    public $system_phone = '';
    public $system_address = '';
    public $system_city = '';
    public $system_state = '';
    public $website = '';


    public function updateSystem()
    {
        $this->validate([
            'system_name' => 'required',
            'system_email' => 'required|email',
            'system_phone' => 'required',
            'system_address' => 'required',
            'system_city' => 'required',
            'system_state' => 'required',
        ], [
            'system_name.required' => 'Vui lòng nhập tên hệ thống.',
            'system_email.required' => 'Vui lòng nhập email hệ thống.',
            'system_email.email' => 'Vui lòng nhập đúng định dạng email hệ thống.',
            'system_phone.required' => 'Vui lòng nhập số điện thoại hệ thống.',
            'system_address.required' => 'Vui lòng nhập địa chỉ.',
            'system_city.required' => 'Vui lòng nhập thành phố.',
            'system_state.required' => 'Vui lòng nhập Tỉnh thành.',
        ]);

        $system_info = System::first();
        $system_info->name = $this->system_name;
        $system_info->email = $this->system_email;
        $system_info->phone = $this->system_phone;
        $system_info->address = $this->system_address;
        $system_info->city = $this->system_city;
        $system_info->state = $this->system_state;
        $system_info->website = $this->website;
        $system_info->save();

        session()->flash('success', 'Cài đặt hệ thống thành công.');
        return redirect()->route('admin');

        // session()->flash('message', 'brand has been updated successfully!');
        // return redirect()->route('admin.systems');
    }

    

    public function render()
    {
        $system_info = System::first();
        $this->system_name = $system_info->name;
        $this->system_email  =  $system_info->email;
        $this->system_phone  =  $system_info->phone;
        $this->system_address  = $system_info->address;
        $this->system_city  =  $system_info->city;
        $this->system_state  =  $system_info->state;
        $this->website  = $system_info->website;

        return view('livewire.admin.system.edit-system', ['system_info' => $system_info]);
    }
}
