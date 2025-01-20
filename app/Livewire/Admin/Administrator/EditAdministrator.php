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
    public $administrator_active = '1';

    public $modules = [];
    public $list_active_modules = '';
    public $list_active_modules_user = '';
    public $list_modules = [];

    public function updateAdministrator()
    {
        $this->validate([
            'administrator_code' => 'required|unique:users,code,' . $this->id,
            'administrator_name' => 'required',
            'administrator_email' => 'required|email|unique:users,email,' . $this->id,
            'administrator_phone' => 'required|numeric',
            'administrator_username' => 'required|unique:users,username,' . $this->id,
            'administrator_password' => 'min:6',
            'administrator_address' => 'required',
        ], [
            'product_code.required' => 'Mã quản trị viên là bắt buộc.',
            'product_code.unique' => 'Mã quản trị viên đã tồn tại.',
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

        $this->list_active_modules_user = '';
        foreach ($this->modules as $module) {
            if ($module['active_yn'] === true || $module['active_yn'] === 'y') {
                $this->list_active_modules_user .= ",".$module['code'];
            }
            if (isset($module['sub_modules'])) {
                foreach ($module['sub_modules'] as $sub_module) {
                    if ($sub_module['active_yn'] === true || $sub_module['active_yn'] === 'y') {
                        $this->list_active_modules_user .= ",".$sub_module['code'];
                    }
                    if (isset($sub_module['sub_sub_modules'])) {
                        foreach ($sub_module['sub_sub_modules'] as $sub_sub_module) {
                            if ($sub_sub_module['active_yn'] === true || $sub_sub_module['active_yn'] === 'y') {
                                $this->list_active_modules_user .= ",".$sub_sub_module['code'];
                            }
                        }
                    }
                }
            }
        }

        if($this->list_active_modules_user == ''){
            $this->dispatch('successPayment', [
                'title' => 'Thất bại',
                'message' => 'Vui lòng chọn Module có thể hiển thị',
                'type' => 'errorNum'
            ]);
            return;
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
        $administrator->active_list = $this->list_active_modules_user;
        $administrator->save();
        return redirect()->route('admin.administrators');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $modules_MAC = [
            ['id' => 1, 'name' => 'Thương Mại Điện Tử', 'code' => 'TMDT', 'active_yn' => 'n', 'active_mac_yn' => 'n', 'sub_modules' => [
                ['id' => 11, 'name' => 'Báo Cáo', 'code' => 'TMDTBC', 'active_yn' => 'n', 'active_mac_yn' => 'n', 'sub_sub_modules' => [
                    ['id' => 111, 'name' => 'Báo Cáo Hàng Tồn Kho', 'code' => 'TMDTBCHT', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                    ['id' => 112, 'name' => 'Báo Cáo Doanh Thu', 'code' => 'TMDTBCDT', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                    ['id' => 113, 'name' => 'Báo Cáo Bán Hàng Theo Mẫu Bán Chạy', 'code' => 'TMDTBCBC', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                    ['id' => 114, 'name' => 'Báo Cáo Bán Hàng Theo Khách Hàng', 'code' => 'TMDTBCKH', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                ]],
                ['id' => 12, 'name' => 'Đơn Hàng', 'code' => 'TMDTDH', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                ['id' => 13, 'name' => 'Danh Mục', 'code' => 'TMDTDM', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                ['id' => 14, 'name' => 'Nhãn Hàng', 'code' => 'TMDTNH', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                ['id' => 15, 'name' => 'Sản Phẩm', 'code' => 'TMDTSP', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                ['id' => 16, 'name' => 'Tồn Kho', 'code' => 'TMDTTK', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                ['id' => 17, 'name' => 'Kho Hàng', 'code' => 'TMDTKH', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                ['id' => 18, 'name' => 'Khách Hàng', 'code' => 'TMDTKY', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
                ['id' => 18, 'name' => 'Quản Lý Công Nợ', 'code' => 'TMDTCN', 'active_yn' => 'n', 'active_mac_yn' => 'n'],
            ]],
        ];
        $this->modules = $modules_MAC;
        $this->list_active_modules = '';
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
       

        $administrators = Administrator::all();
        $administrator = Administrator::find($this->id);
        $this->administrator_code = $administrator->code;
        $this->administrator_name = $administrator->name;
        $this->administrator_email = $administrator->email;
        $this->administrator_phone = $administrator->phone;
        $this->administrator_gender = $administrator->gender;
        $this->administrator_username = $administrator->username;
        $this->administrator_password = "";
        $this->administrator_address = $administrator->address;
        $this->administrator_active = $administrator->is_active;
        if($administrator->avatar_user){
            $this->existedPhoto = "images/administrators/" . $administrator->avatar_user;
        }
        $this->list_active_modules_user = '';
        $this->list_active_modules_user = auth()->user()->where('code', $administrator->code)->first()->active_list ?? '';
        if (!is_null($this->list_active_modules_user) && !empty($this->list_active_modules_user)) {
            
            foreach ($this->modules as $key => $module) {
               
                if (in_array($module['code'], explode(',', $this->list_active_modules_user))) {
                    $this->modules[$key]['active_yn'] = 'y';
                }else{
                    $this->modules[$key]['active_yn'] = 'n';
                }
                if (isset($module['sub_modules'])) {
                    foreach ($module['sub_modules'] as $sub_key => $sub_module) {
                        if (in_array($sub_module['code'], explode(',', $this->list_active_modules_user))) {
                            $this->modules[$key]['sub_modules'][$sub_key]['active_yn'] = 'y';
                        }else{
                            $this->modules[$key]['sub_modules'][$sub_key]['active_yn'] = 'n';
                        }
                        if (isset($sub_module['sub_sub_modules'])) {
                            foreach ($sub_module['sub_sub_modules'] as $sub_sub_key => $sub_sub_module) {
                                if (in_array($sub_sub_module['code'], explode(',', $this->list_active_modules_user))) {
                                    $this->modules[$key]['sub_modules'][$sub_key]['sub_sub_modules'][$sub_sub_key]['active_yn'] = 'y';
                                }else{
                                    $this->modules[$key]['sub_modules'][$sub_key]['sub_sub_modules'][$sub_sub_key]['active_yn'] = 'n';
                                }
                            }
                        }
                    }
                }
            }
        }

        return view('livewire.admin.administrator.edit-administrator',  ['administrator' => $administrator, 'modules' => $this->modules]);
    }
}
