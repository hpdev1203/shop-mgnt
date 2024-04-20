<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class EditUser extends Component
{
    use WithFileUploads;
    public $id;
    public $user_name = '';
    public $user_email = '';
    public $user_phone = '';
    public $user_gender = '1';
    public $user_username = '';
    public $user_password = '';
    public $user_address = '';
    public $photo;
    public $existedPhoto;

    public function updateUser()
    {
        $this->validate([
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users,email,' . $this->id,
            'user_phone' => 'required|numeric',
            'user_username' => 'required|unique:users,username,' . $this->id,
            'user_password' => 'min:6',
            'user_address' => 'required',
        ], [
            'user_name.required' => 'Vui lòng nhập tên khách hàng.',
            'user_email.required' => 'Vui lòng nhập email khách hàng.',
            'user_email.email' => 'Vui lòng nhập đúng định dạng email.',
            'user_email.unique' => 'Email đã tồn tại.',
            'user_phone.required' => 'Vui lòng nhập số điện thoại khách hàng.',
            'user_phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại.',
            'user_username.required' => 'Vui lòng nhập tên đăng nhập khách hàng',
            'user_username.unique' => 'Tên đăng nhập đã tồn tại.',
            'user_password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'user_address.required' => 'Vui lòng nhập địa chỉ khách hàng.',
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

        $user = User::find($this->id);
        $user->name = $this->user_name;
        $user->email = $this->user_email;
        $user->phone = $this->user_phone;
        $user->gender = $this->user_gender;
        $user->username = $this->user_username;
        if ($this->user_password) {
            $user->password = Hash::make($this->user_password);
        }
        if ($this->photo) {
            $user->avatar_user = $photo_name;
        }
        $user->address = $this->user_address;
        $user->save();
        return redirect()->route('admin.users');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $users = User::all();
        $user = User::find($this->id);
        $this->user_name = $user->name;
        $this->user_email = $user->email;
        $this->user_phone = $user->phone;
        $this->user_gender = $user->gender;
        $this->user_username = $user->username;
        $this->user_password = "";
        $this->user_address = $user->address;
        if($user->avatar_user){
            $this->existedPhoto = "images/users/" . $user->avatar_user;
        }
        return view('livewire.admin.user.edit-user', ['users' => $users]);
    }
}
