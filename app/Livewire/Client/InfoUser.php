<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InfoUser extends Component
{
    use WithFileUploads;
    public $user_code = '';
    public $user_name = '';
    public $user_email = '';
    public $user_phone = '';
    public $user_gender = '1';
    public $user_address = '';
    public $user_state = '';
    public $user_city = '';
    public $photo;
    public $existedPhoto;

    public function updateInfoUser()
    {
        $this->validate([
            'user_name' => 'required',
            'user_email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'user_address' => 'required',
            'user_state' => 'required',
            'user_city' => 'required',
        ], [
            'user_name.required' => 'Vui lòng nhập tên.',
            'user_email.required' => 'Vui lòng nhập email.',
            'user_email.email' => 'Vui lòng nhập đúng định dạng email.',
            'user_email.unique' => 'Email đã tồn tại.',
            'user_address.required' => 'Vui lòng nhập địa chỉ.',
            'user_state.required' => 'Vui lòng nhập quận/huyện.',
            'user_city.required' => 'Vui lòng nhập tỉnh/thành phố.',
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

        $user = User::find(Auth::user()->id);
        $user->name = $this->user_name;
        $user->email = $this->user_email;
        $user->phone = $this->user_phone;
        $user->gender = $this->user_gender;
        if ($this->photo) {
            $user->avatar_user = $photo_name;
        }
        $user->address = $this->user_address;
        $user->state = $this->user_state;
        $user->city = $this->user_city;
        $user->save();
        $this->dispatch('successInfoUser', [
            'title' => 'Thành công',
            'message' => 'Thông tin đã được cập nhật',
            'type' => 'success',
            'timeout' => 3000
        ]);
    }

    public function render()
    {
        $user = User::find(Auth::user()->id);
        $this->user_name = $user->name;
        $this->user_email = $user->email;
        $this->user_phone = $user->phone;
        $this->user_gender = $user->gender;
        $this->user_address = $user->address;
        $this->user_state = $user->state;
        $this->user_city = $user->city;
        if($user->avatar_user){
            $this->existedPhoto = "images/users/" . $user->avatar_user;
        }
        return view('livewire.client.info-user', ['user' => $user]);
    }
}
