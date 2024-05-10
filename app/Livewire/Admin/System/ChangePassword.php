<?php

namespace App\Livewire\Admin\System;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePassword extends Component
{
    public $password_old = "";
    public $password_new = "";
    public $confirm_password = "";

    public function changePassword()
    {
        $this->validate([
            'password_old' => 'required|min:6',
            'password_new' => 'required|min:6|different:password_old',
            'confirm_password' => 'required|min:6|same:password_new',
        ], [
            'password_old.required' => 'Vui lòng nhập mật khẩu cũ.',
            'password_old.min' => 'Vui lòng nhập ít nhất 6 ký tự',
            'password_new.required' => 'Vui lòng nhập mật khẩu mới.',
            'password_new.different' => 'Mật khẩu mới trùng với mật khẩu cũ.',
            'password_new.min' => 'Vui lòng nhập ít nhất 6 ký tự',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới.',
            'confirm_password.same' => 'Nhập lại mật khẩu mới không khớp.',
            'confirm_password.min' => 'Vui lòng nhập ít nhất 6 ký tự',
        ]);

        $admin = User::find(Auth::user()->id);
        $credentials = $admin->username;
        if (!filter_var($credentials, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['username' => $credentials, 'password' => $this->password_old];
        }
        if (auth()->attempt($credentials)) {
            $admin->password = Hash::make($this->password_new);
            $admin->save();
            $this->dispatch('successChangePassword', [
                'title' => 'Thành công',
                'message' => 'Bạn đã đổi mật khẩu thành công',
                'type' => 'success',
                'timeout' => 3000
            ]);
        }else{
            session()->flash('error', 'Sai mật khẩu.');
        }
    }

    public function render()
    {
        return view('livewire.admin.system.change-password');
    }
}
