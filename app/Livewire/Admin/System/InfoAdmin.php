<?php

namespace App\Livewire\Admin\System;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InfoAdmin extends Component
{
    use WithFileUploads;
    public $admin_username = '';
    public $admin_name = '';
    public $admin_email = '';
    public $admin_phone = '';
    public $admin_gender = '1';
    public $admin_address = '';
    public $admin_state = '';
    public $admin_city = '';
    public $photo;
    public $existedPhoto;

    public function updateInfoAdmin()
    {
        $this->validate([
            'admin_username' => 'required|unique:users,username,' . Auth::user()->id,
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'admin_address' => 'required',
            'admin_state' => 'required',
            'admin_city' => 'required',
        ], [
            'admin_username.required' => 'Vui lòng nhập tên đăng nhập.',
            'admin_username.unique' => 'Tên đăng nhập đã tồn tại.',
            'admin_name.required' => 'Vui lòng nhập tên.',
            'admin_email.required' => 'Vui lòng nhập email.',
            'admin_email.email' => 'Vui lòng nhập đúng định dạng email.',
            'admin_email.unique' => 'Email đã tồn tại.',
            'admin_address.required' => 'Vui lòng nhập địa chỉ.',
            'admin_state.required' => 'Vui lòng nhập quận/huyện.',
            'admin_city.required' => 'Vui lòng nhập tỉnh/thành phố.',
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
            $photo_name = time() . '.' . $this->photo->extension();
            ImageOptimizer::optimize($this->photo->path());
            $this->photo->storeAs(path: "public\images\users", name: $photo_name);
        }

        $admin = User::find(Auth::user()->id);
        $admin->username = $this->admin_username;
        $admin->name = $this->admin_name;
        $admin->email = $this->admin_email;
        $admin->phone = $this->admin_phone;
        $admin->gender = $this->admin_gender;
        if ($this->photo) {
            $admin->avatar_user = $photo_name;
        }
        $admin->address = $this->admin_address;
        $admin->state = $this->admin_state;
        $admin->city = $this->admin_city;
        $admin->save();
        $this->dispatch('successInfoAdmin', [
            'title' => 'Thành công',
            'message' => 'Thông tin đã được cập nhật',
            'type' => 'success',
            'timeout' => 3000
        ]);
    }

    public function render()
    {
        $admin = User::find(Auth::user()->id);
        $this->admin_username = $admin->username;
        $this->admin_name = $admin->name;
        $this->admin_email = $admin->email;
        $this->admin_phone = $admin->phone;
        $this->admin_gender = $admin->gender;
        $this->admin_address = $admin->address;
        $this->admin_state = $admin->state;
        $this->admin_city = $admin->city;
        if($admin->avatar_user){
            $this->existedPhoto = "images/users/" . $admin->avatar_user;
        }
        return view('livewire.admin.system.info-admin' , ['admin' => $admin]);
    }
}
