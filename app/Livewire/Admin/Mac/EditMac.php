<?php

namespace App\Livewire\Admin\Mac;

use Livewire\Component;
use App\Models\Mac;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class EditMac extends Component
{
    use WithFileUploads;

    public $Mac_name = '';
    public $Mac_email = '';
    public $Mac_phone = '';
    public $Mac_address = '';
    public $Mac_city = '';
    public $Mac_state = '';
    public $website = '';
    public $photo;
    public $existedPhoto;

    public $modules = [];
    public $list_active_modules = '';
    public $list_modules = [];

    public function updateMac()
    {
        $this->list_active_modules = '';
        foreach ($this->modules as $module) {
            if ($module['active_yn'] === true || $module['active_yn'] === 'y') {
                $this->list_active_modules .= ",".$module['code'];
            }
            if (isset($module['sub_modules'])) {
                foreach ($module['sub_modules'] as $sub_module) {
                    if ($sub_module['active_yn'] === true || $sub_module['active_yn'] === 'y') {
                        $this->list_active_modules .= ",".$sub_module['code'];
                    }
                    if (isset($sub_module['sub_sub_modules'])) {
                        foreach ($sub_module['sub_sub_modules'] as $sub_sub_module) {
                            if ($sub_sub_module['active_yn'] === true || $sub_sub_module['active_yn'] === 'y') {
                                $this->list_active_modules .= ",".$sub_sub_module['code'];
                            }
                        }
                    }
                }
            }
        }
        $user = auth()->user();
        $user->active_list = $this->list_active_modules;
        $user->save();
        session()->flash('success', 'Cài đặt hệ thống thành công.');
        return redirect()->route('admin');
        // session()->flash('message', 'brand has been updated successfully!');
        // return redirect()->route('admin.Macs');
    }

    public function updatedModules($value)
    {
        foreach ($this->modules as $index => $module) {
            // Nếu active_yn là null (checkbox không được chọn), chuyển thành 'n'
            if (is_null($this->modules[$index]['active_yn'])) {
                $this->modules[$index]['active_yn'] = 'n';
            }
        }
    }

    public function render()
    {
        $modules_MAC = [
            ['id' => 1, 'name' => 'Thương Mại Điện Tử', 'code' => 'TMDT', 'active_yn' => 'y', 'sub_modules' => [
                ['id' => 11, 'name' => 'Báo Cáo', 'code' => 'TMDTBC', 'active_yn' => 'y', 'sub_sub_modules' => [
                    ['id' => 111, 'name' => 'Báo Cáo Hàng Tồn Kho', 'code' => 'TMDTBCHT', 'active_yn' => 'y'],
                    ['id' => 12, 'name' => 'Báo Cáo Doanh Thu', 'code' => 'TMDTBCDT', 'active_yn' => 'y'],
                    ['id' => 12, 'name' => 'Báo Cáo Bán Hàng Theo Mẫu Bán Chạy', 'code' => 'TMDTBCBC', 'active_yn' => 'y'],
                    ['id' => 12, 'name' => 'Báo Cáo Bán Hàng Theo Khách Hàng', 'code' => 'TMDTBCKH', 'active_yn' => 'y'],
                ]],
                ['id' => 12, 'name' => 'Đơn Hàng', 'code' => 'TMDTDH', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Danh Mục', 'code' => 'TMDTDM', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Thể Loại', 'code' => 'TMDTNH', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Sản Phẩm', 'code' => 'TMDTSP', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Tồn Kho', 'code' => 'TMDTTK', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Kho Hàng', 'code' => 'TMDTKH', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Khách Hàng', 'code' => 'TMDTKY', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Quản Lý Công Nợ', 'code' => 'TMDTCN', 'active_yn' => 'y'],
            ]],
            ['id' => 2, 'name' => 'Cài Đặt', 'code' => 'CDTM', 'active_yn' => 'y', 'sub_modules' => [
                ['id' => 13, 'name' => 'Phương Thức Thanh Toán', 'code' => 'CDTMTT', 'active_yn' => 'y'],
            ]],
            ['id' => 3, 'name' => 'Hệ Thống', 'code' => 'HTTM', 'active_yn' => 'y', 'sub_modules' => [
                ['id' => 15, 'name' => 'Quản Trị Viên', 'code' => 'HTTMQT', 'active_yn' => 'y'],
                ['id' => 16, 'name' => 'Cài Đặt Hệ Thống', 'code' => 'HTTMCD', 'active_yn' => 'y'],
            ]],
        ];
        $this->list_active_modules = auth()->user()->active_list;
        
        $this->modules = $modules_MAC;
        if (!is_null($this->list_active_modules) && !empty($this->list_active_modules)) {
            
            foreach ($this->modules as $key => $module) {
               
                if (in_array($module['code'], explode(',', $this->list_active_modules))) {
                    $this->modules[$key]['active_yn'] = 'y';
                }else{
                    $this->modules[$key]['active_yn'] = 'n';
                }
                if (isset($module['sub_modules'])) {
                    foreach ($module['sub_modules'] as $sub_key => $sub_module) {
                        if (in_array($sub_module['code'], explode(',', $this->list_active_modules))) {
                            $this->modules[$key]['sub_modules'][$sub_key]['active_yn'] = 'y';
                        }else{
                            $this->modules[$key]['sub_modules'][$sub_key]['active_yn'] = 'n';
                        }
                        if (isset($sub_module['sub_sub_modules'])) {
                            foreach ($sub_module['sub_sub_modules'] as $sub_sub_key => $sub_sub_module) {
                                if (in_array($sub_sub_module['code'], explode(',', $this->list_active_modules))) {
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

        return view('livewire.admin.mac.edit-mac', ['modules' => $this->modules]);
    }
}
