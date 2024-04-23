<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email_username = '';
    public $password = '';
    public $remember = '';

    public function handleLogin()
    {
        $this->validate([
            'email_username' => 'required',
            'password' => 'required',
        ], [
            'email_username.required' => 'Vui lòng nhập email hoặc tên đăng nhập.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $credentials = $this->email_username;

        if (filter_var($credentials, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $credentials, 'password' => $this->password,];
        } else {
            $credentials = ['username' => $credentials, 'password' => $this->password];
        }

        if (auth()->attempt($credentials, $this->remember)) {
            if(auth()->user()->is_active == false){
                auth()->logout();
                session()->flash('error', 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.');
                return;
            }
            if(auth()->user()->role == 'customer'){
                auth()->logout();
                session()->flash('error', 'Tài khoản của bạn không có quyền truy cập.');
                return;
            }
            return redirect()->route('admin');
        }else{
            session()->flash('error', 'Thông tin đăng nhập không chính xác.');
        }
    }

    public function handleLogout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }   

    public function render()
    {
        return view('livewire.admin.auth.login')->title('Đăng nhập hệ thống');
    }
}
