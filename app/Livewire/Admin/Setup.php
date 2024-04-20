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
    public $system_address = '';
    public $system_city = '';
    public $system_state = '';
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
            'system_address' => 'required',
            'system_city' => 'required',
            'system_state' => 'required',
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
            'system_address.required' => 'Vui lòng nhập địa chỉ.',
            'system_city.required' => 'Vui lòng nhập thành phố.',
            'system_state.required' => 'Vui lòng nhập Tỉnh thành.',
        ]);

        $user = new User();
        $user->code = 'SUPERADMIN';
        $user->name = $this->name;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->password = Hash::make($this->password);
        $user->role = 'system';
        $user->is_super_admin = true;
        $user->save();

        $system_info = new SystemInfo();
        $system_info->name = $this->system_name;
        $system_info->email = $this->system_email;
        $system_info->phone = $this->system_phone;
        $system_info->address = $this->system_address;
        $system_info->city = $this->system_city;
        $system_info->state = $this->system_state;
        $system_info->website = $this->website;
        $system_info->save();

        $setup = SetupModel::first();
        if(!$setup) {
            $setup = new SetupModel();
        }
        $setup->is_completed = true;
        $setup->save();

        session()->flash('success', 'Cài đặt hệ thống thành công.');
        return redirect()->route('admin');
    }

    public function render()
    {
        return view('livewire.admin.setup')->title('Setup hệ thống');
    }
}
