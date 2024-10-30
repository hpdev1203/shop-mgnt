<?php

namespace App\Livewire\Admin\Mac;

use Livewire\Component;
use App\Models\Mac;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class EditMac extends Component
{
    use WithFileUploads;

    public $Mac_name = '';
    public $Mac_email = '';
    public $Mac_phone = '';
    public $Mac_address = '';
    public $Mac_city = '';
    public $Mac_state = '';
    public $website = '';
    public $photo;
    public $existedPhoto;


    public function updateMac()
    {
        $this->validate([
            'Mac_name' => 'required',
            'Mac_email' => 'required|email',
            'Mac_phone' => 'required',
            'Mac_address' => 'required',
            'Mac_city' => 'required',
            'Mac_state' => 'required',
        ], [
            'Mac_name.required' => 'Vui lòng nhập tên hệ thống.',
            'Mac_email.required' => 'Vui lòng nhập email hệ thống.',
            'Mac_email.email' => 'Vui lòng nhập đúng định dạng email hệ thống.',
            'Mac_phone.required' => 'Vui lòng nhập số điện thoại hệ thống.',
            'Mac_address.required' => 'Vui lòng nhập địa chỉ.',
            'Mac_city.required' => 'Vui lòng nhập thành phố.',
            'Mac_state.required' => 'Vui lòng nhập Tỉnh thành.',
        ]);
        if ($this->photo) {
            $this->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ], [
                'photo.image' => 'File không phải là ảnh',
                'photo.mimes' => 'Ảnh không đúng định dạng',
                'photo.max' => 'Ảnh không được lớn hơn 2MB'
            ]);
            Storage::delete('public\\' . $this->existedPhoto);
            $photo_name = time() . uniqid() . '.' . $this->photo->extension();
            ImageOptimizer::optimize($this->photo->path());
            $this->photo->storeAs(path: "public\images\Macs", name: $photo_name);
        }

        $Mac_info = Mac::first();
        $Mac_info->name = $this->Mac_name;
        $Mac_info->email = $this->Mac_email;
        $Mac_info->phone = $this->Mac_phone;
        $Mac_info->address = $this->Mac_address;
        $Mac_info->city = $this->Mac_city;
        $Mac_info->state = $this->Mac_state;
        $Mac_info->website = $this->website;
        if ($this->photo) {
            $Mac_info->logo = $photo_name;
        }
        $Mac_info->save();

        session()->flash('success', 'Cài đặt hệ thống thành công.');
        return redirect()->route('admin');

        // session()->flash('message', 'brand has been updated successfully!');
        // return redirect()->route('admin.Macs');
    }

    

    public function render()
    {
        $Mac_info = Mac::first();
        $this->Mac_name = $Mac_info->name;
        $this->Mac_email  =  $Mac_info->email;
        $this->Mac_phone  =  $Mac_info->phone;
        $this->Mac_address  = $Mac_info->address;
        $this->Mac_city  =  $Mac_info->city;
        $this->Mac_state  =  $Mac_info->state;
        $this->website  = $Mac_info->website;
        if($Mac_info->logo){
            $this->existedPhoto = "images/Macs/" . $Mac_info->logo;
        }
        return view('livewire.admin.Mac.edit-Mac', ['Mac_info' => $Mac_info]);
    }
}
