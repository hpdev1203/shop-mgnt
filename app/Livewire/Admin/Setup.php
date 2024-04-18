<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Setup as SetupModel;
use Illuminate\Support\Facades\Hash;
use App\Models\System as SystemInfo;
use App\Models\User;

class Setup extends Component
{
    public $isCompleted = false;
    public $name = '';
    public $username = '';
    public $email = '';
    public $password = '';
    public $confirm_password = '';
    public $system_name = '';
    public $system_email = '';
    public $system_phone = '';
    public $address = '';
    public $website = '';

    public function handleSubmit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6|same:password',
            'system_name' => 'required',
            'system_email' => 'required|email',
            'system_phone' => 'required',
            'address' => 'required',
            'website' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.same' => 'Mật khẩu xác nhận không khớp.',
            'confirm_password.required' => 'Vui lòng nhập mật khẩu xác nhận.',
            'system_name.required' => 'Vui lòng nhập tên hệ thống.',
            'system_email.required' => 'Vui lòng nhập email hệ thống.',
            'system_email.email' => 'Vui lòng nhập đúng định dạng email hệ thống.',
            'system_phone.required' => 'Vui lòng nhập số điện thoại hệ thống.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'website.required' => 'Vui lòng nhập địa chỉ website.',
        ]);


        $setup = SetupModel::first();
        if(!$setup) {
            $setup = new SetupModel();
        }
        $setup->is_completed = true;
        $setup->save();

        $system_info = new SystemInfo();
        $system_info->name = $this->system_name;
        $system_info->email = $this->system_email;
        $system_info->phone = $this->system_phone;
        $system_info->address = $this->address;
        $system_info->website = $this->website;
        $system_info->save();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->password = Hash::make($this->password);
        $user->role = 'system';
        $user->save();

        session()->flash('success', 'Cài đặt hệ thống thành công.');
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.setup')->title('Setup hệ thống');
    }
}
