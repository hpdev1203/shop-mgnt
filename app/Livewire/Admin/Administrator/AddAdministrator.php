<?php

namespace App\Livewire\Admin\Administrator;

use Livewire\Component;
use App\Models\User as Administrator;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class AddAdministrator extends Component
{   
    use WithFileUploads;
    public $administrator_code = '';
    public $administrator_name = '';
    public $administrator_email = '';
    public $administrator_phone = '';
    public $administrator_gender = '1';
    public $administrator_username = '';
    public $administrator_password = '';
    public $administrator_address = '';
    public $photo;
    public $existedPhoto;
    public $administrator_role = 'system';
    public $administrator_active = '1';

    public $modules = [];
    public $list_active_modules = '';
    public $list_modules = [];

    public function storeAdministrator()
    {
        $this->list_active_modules = '';
        foreach ($this->modules as $module) {
            if ($module['active_yn'] != false) {
                $this->list_active_modules .= ",".$module['code'];
            }
            if (isset($module['sub_modules'])) {
                foreach ($module['sub_modules'] as $sub_module) {
                    if ($sub_module['active_yn'] != false) {
                        $this->list_active_modules .= ",".$sub_module['code'];
                    }
                    if (isset($sub_module['sub_sub_modules'])) {
                        foreach ($sub_module['sub_sub_modules'] as $sub_sub_module) {
                            if ($sub_sub_module['active_yn'] != false) {
                                $this->list_active_modules .= ",".$sub_sub_module['code'];
                            }
                        }
                    }
                }
            }
        }

        if($this->list_active_modules == ''){
            $this->dispatch('successPayment', [
                'title' => 'Thất bại',
                'message' => 'Vui lòng chọn Module có thể hiển thị',
                'type' => 'errorNum'
            ]);
            return;
        }

        $this->validate([
            'administrator_code' => 'required|unique:users,code',
            'administrator_name' => 'required',
            'administrator_email' => 'required|email|unique:users,email',
            'administrator_phone' => 'required|numeric',
            'administrator_username' => 'required|unique:users,username',
            'administrator_password' => 'required|min:6',
            'administrator_address' => 'required',
        ], [
            'administrator_code.required' => 'Mã quản trị viên là bắt buộc.',
            'administrator_code.unique' => 'Mã quản trị viên đã tồn tại.',
            'administrator_name.required' => 'Vui lòng nhập tên quản trị viên.',
            'administrator_email.required' => 'Vui lòng nhập email quản trị viên.',
            'administrator_email.email' => 'Vui lòng nhập đúng định dạng email.',
            'administrator_email.unique' => 'Email đã tồn tại.',
            'administrator_phone.required' => 'Vui lòng nhập số điện thoại quản trị viên.',
            'administrator_phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại.',
            'administrator_username.required' => 'Vui lòng nhập tên đăng nhập quản trị viên',
            'administrator_username.unique' => 'Tên đăng nhập đã tồn tại.',
            'administrator_password.required' => 'Vui lòng nhập mật khẩu quản trị viên.',
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
        

        $administrator = new Administrator();
        $administrator->code = $this->administrator_code;
        $administrator->name = $this->administrator_name;
        $administrator->email = $this->administrator_email;
        $administrator->phone = $this->administrator_phone;
        $administrator->gender = $this->administrator_gender;
        $administrator->username = $this->administrator_username;
        $administrator->password = Hash::make($this->administrator_password);
        $administrator->address = $this->administrator_address;
        $administrator->role = $this->administrator_role;
        $administrator->is_active = $this->administrator_active;
        $administrator->active_list = $this->list_active_modules;
        if ($this->photo) {
            $administrator->avatar_user = $photo_name;
        }
        $administrator->save();
        return redirect()->route('admin.administrators');
    }
    public function render()
    {
        $modules_MAC = [
            ['id' => 1, 'name' => 'Thương Mại Điện Tử', 'code' => 'TMDT', 'active_yn' => 'y', 'active_mac_yn' => 'n', 'sub_modules' => [
                ['id' => 11, 'name' => 'Báo Cáo', 'code' => 'TMDTBC', 'active_yn' => 'y', 'active_mac_yn' => 'n', 'sub_sub_modules' => [
                    ['id' => 111, 'name' => 'Báo Cáo Hàng Tồn Kho', 'code' => 'TMDTBCHT', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                    ['id' => 12, 'name' => 'Báo Cáo Doanh Thu', 'code' => 'TMDTBCDT', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                    ['id' => 12, 'name' => 'Báo Cáo Bán Hàng Theo Mẫu Bán Chạy', 'code' => 'TMDTBCBC', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                    ['id' => 12, 'name' => 'Báo Cáo Bán Hàng Theo Khách Hàng', 'code' => 'TMDTBCKH', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                ]],
                ['id' => 12, 'name' => 'Đơn Hàng', 'code' => 'TMDTDH', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                ['id' => 12, 'name' => 'Danh Mục', 'code' => 'TMDTDM', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                ['id' => 12, 'name' => 'Thể Loại', 'code' => 'TMDTNH', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                ['id' => 12, 'name' => 'Sản Phẩm', 'code' => 'TMDTSP', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                ['id' => 12, 'name' => 'Tồn Kho', 'code' => 'TMDTTK', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                ['id' => 12, 'name' => 'Kho Hàng', 'code' => 'TMDTKH', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                ['id' => 12, 'name' => 'Khách Hàng', 'code' => 'TMDTKY', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
                ['id' => 12, 'name' => 'Quản Lý Công Nợ', 'code' => 'TMDTCN', 'active_yn' => 'y', 'active_mac_yn' => 'n'],
            ]],
        ];
        $this->modules = $modules_MAC;
        $this->list_active_modules = auth()->user()->where('code', 'M8ADMIN')->first()->active_list ?? '';
        if (!is_null($this->list_active_modules) && !empty($this->list_active_modules)) {
            foreach ($this->modules as $key => $module) {
               
                if (in_array($module['code'], explode(',', $this->list_active_modules))) {
                    $this->modules[$key]['active_mac_yn'] = 'y';
                }else{
                    $this->modules[$key]['active_mac_yn'] = 'n';
                }
                if (isset($module['sub_modules'])) {
                    foreach ($module['sub_modules'] as $sub_key => $sub_module) {
                        if (in_array($sub_module['code'], explode(',', $this->list_active_modules))) {
                            $this->modules[$key]['sub_modules'][$sub_key]['active_mac_yn'] = 'y';
                        }else{
                            $this->modules[$key]['sub_modules'][$sub_key]['active_mac_yn'] = 'n';
                        }
                        if (isset($sub_module['sub_sub_modules'])) {
                            foreach ($sub_module['sub_sub_modules'] as $sub_sub_key => $sub_sub_module) {
                                if (in_array($sub_sub_module['code'], explode(',', $this->list_active_modules))) {
                                    $this->modules[$key]['sub_modules'][$sub_key]['sub_sub_modules'][$sub_sub_key]['active_mac_yn'] = 'y';
                                }else{
                                    $this->modules[$key]['sub_modules'][$sub_key]['sub_sub_modules'][$sub_sub_key]['active_mac_yn'] = 'n';
                                }
                            }
                        }
                    }
                }
            }
        }
      
        $Administrators = Administrator::all();
        $id_latest = Administrator::latest('id')->first();
        if($id_latest == null){
            $id_latest = (object) ['id' => 0];
        }   
        $this->administrator_code = 'ADM-'.str_pad($id_latest->id + 1, 4, '0', STR_PAD_LEFT);

        return view('livewire.admin.administrator.add-administrator', ['administrator' => $Administrators, 'modules' => $this->modules]);
    }
}
