<?php

namespace App\Livewire\Admin\Administrator;

use Livewire\Component;
use App\Models\User as Administrator;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class EditAdministrator extends Component
{
    use WithFileUploads;
    public $id;
    public $administrator_name = '';
    public $administrator_email = '';
    public $administrator_phone = '';
    public $administrator_gender = '1';
    public $administrator_username = '';
    public $administrator_password = '';
    public $administrator_address = '';
    public $photo;
    public $existedPhoto;
    public $administrator_active = '1';

    public function updateAdministrator()
    {
        $this->validate([
            'administrator_name' => 'required',
            'administrator_email' => 'required|email|unique:users,email,' . $this->id,
            'administrator_phone' => 'required|numeric',
            'administrator_username' => 'required|unique:users,username,' . $this->id,
            'administrator_password' => 'min:6',
            'administrator_address' => 'required',
        ], [
            'administrator_name.required' => 'Vui lòng nhập tên quản trị viên.',
            'administrator_email.required' => 'Vui lòng nhập email quản trị viên.',
            'administrator_email.email' => 'Vui lòng nhập đúng định dạng email.',
            'administrator_email.unique' => 'Email đã tồn tại.',
            'administrator_phone.required' => 'Vui lòng nhập số điện thoại quản trị viên.',
            'administrator_phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại.',
            'administrator_username.required' => 'Vui lòng nhập tên đăng nhập quản trị viên',
            'administrator_username.unique' => 'Tên đăng nhập đã tồn tại.',
            'administrator_password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'administrator_address.required' => 'Vui lòng nhập địa chỉ quản trị viên.',
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
            $this->photo->storeAs(path: "public\images\administrators", name: $photo_name);
        }

        $administrator = Administrator::find($this->id);
        $administrator->name = $this->administrator_name;
        $administrator->email = $this->administrator_email;
        $administrator->phone = $this->administrator_phone;
        $administrator->gender = $this->administrator_gender;
        $administrator->username = $this->administrator_username;
        if ($this->administrator_password) {
            $administrator->password = Hash::make($this->administrator_password);
        }
        if ($this->photo) {
            $administrator->avatar_user = $photo_name;
        }
        $administrator->address = $this->administrator_address;
        $administrator->is_active = $this->administrator_active;
        $administrator->save();
        return redirect()->route('admin.administrators');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $administrators = Administrator::all();
        $administrator = Administrator::find($this->id);
        $this->administrator_name = $administrator->name;
        $this->administrator_email = $administrator->email;
        $this->administrator_phone = $administrator->phone;
        $this->administrator_gender = $administrator->gender;
        $this->administrator_username = $administrator->username;
        $this->administrator_password = "";
        $this->administrator_address = $administrator->address;
        $this->administrator_active = $administrator->is_active;
        if($administrator->avatar_administrator){
            $this->existedPhoto = "images/administrators/" . $administrator->avatar_administrator;
        }
        return view('livewire.admin.administrator.edit-administrator', ['administrator' => $administrator]);
    }
}
