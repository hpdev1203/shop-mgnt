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
    public $TMDT = '1';

    public function updateMac()
    {
        dd($this->TMDT);
        foreach ($this->modules as $module) {
            if ($module['active_yn'] == 'y') {
               
                $this->list_active_modules .= ",".$module['code'];
            }
            if (isset($module['sub_modules'])) {
                foreach ($module['sub_modules'] as $sub_module) {
                    if ($sub_module['active_yn'] == 'y') {
                        $this->list_active_modules .= ",".$sub_module['code'];
                    }
                    if (isset($sub_module['sub_sub_modules'])) {
                        foreach ($sub_module['sub_sub_modules'] as $sub_sub_module) {
                            if ($sub_sub_module['active_yn'] == 'y') {
                                $this->list_active_modules .= ",".$sub_sub_module['code'];
                            }
                        }
                    }
                }
            }
        }
        dd($this->list_active_modules);
        $this->validate([
            'Mac_name' => 'required',
            'Mac_email' => 'required|email',
            'Mac_phone' => 'required',
            'Mac_address' => 'required',
            'Mac_city' => 'required',
            'Mac_state' => 'required',
        ], [
            'Mac_name.required' => 'Vui lòng nhập tên hệ thống.',
            'Mac_email.required' => 'Vui lòng nhập email hệ thống.',
            'Mac_email.email' => 'Vui lòng nhập đúng định dạng email hệ thống.',
            'Mac_phone.required' => 'Vui lòng nhập số điện thoại hệ thống.',
            'Mac_address.required' => 'Vui lòng nhập địa chỉ.',
            'Mac_city.required' => 'Vui lòng nhập thành phố.',
            'Mac_state.required' => 'Vui lòng nhập Tỉnh thành.',
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
            $photo_name = time() . uniqid() . '.' . $this->photo->extension();
            ImageOptimizer::optimize($this->photo->path());
            $this->photo->storeAs(path: "public\images\Macs", name: $photo_name);
        }

        $Mac_info = Mac::first();
        $Mac_info->name = $this->Mac_name;
        $Mac_info->email = $this->Mac_email;
        $Mac_info->phone = $this->Mac_phone;
        $Mac_info->address = $this->Mac_address;
        $Mac_info->city = $this->Mac_city;
        $Mac_info->state = $this->Mac_state;
        $Mac_info->website = $this->website;
        if ($this->photo) {
            $Mac_info->logo = $photo_name;
        }
        $Mac_info->save();

        session()->flash('success', 'Cài đặt hệ thống thành công.');
        return redirect()->route('admin');

        // session()->flash('message', 'brand has been updated successfully!');
        // return redirect()->route('admin.Macs');
    }

    

    public function render()
    {
        $modules = [
            ['id' => 1, 'name' => 'Thương Mại Điện Tử', 'code' => 'TMDT', 'active_yn' => 'y', 'sub_modules' => [
                ['id' => 11, 'name' => 'Báo Cáo', 'code' => 'TMDTBC', 'active_yn' => 'y', 'sub_sub_modules' => [
                    ['id' => 111, 'name' => 'Báo Cáo Hàng Tồn Kho', 'code' => 'TMDTBCHT', 'active_yn' => 'y'],
                    ['id' => 12, 'name' => 'Báo Cáo Doanh Thu', 'code' => 'TMDTBCDT', 'active_yn' => 'y'],
                    ['id' => 12, 'name' => 'Báo Cáo Bán Hàng Theo Mẫu Bán Chạy', 'code' => 'TMDTBCBC', 'active_yn' => 'y'],
                    ['id' => 12, 'name' => 'Báo Cáo Bán Hàng Theo Khách Hàng', 'code' => 'TMDTBCKH', 'active_yn' => 'y'],
                ]],
                ['id' => 12, 'name' => 'Đơn Hàng', 'code' => 'TMDTDH', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Danh Mục', 'code' => 'TMDTDM', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Nhãn Hàng', 'code' => 'TMDTNH', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Sản Phẩm', 'code' => 'TMDTSP', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Tồn Kho', 'code' => 'TMDTTK', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Kho Hàng', 'code' => 'TMDTKH', 'active_yn' => 'y'],
                ['id' => 12, 'name' => 'Khách Hàng', 'code' => 'TMDTKY', 'active_yn' => 'y'],
            ]],
            ['id' => 2, 'name' => 'Cài Đặt', 'code' => 'CDTM', 'active_yn' => 'y', 'sub_modules' => [
                ['id' => 13, 'name' => 'Phương Thức Thanh Toán', 'code' => 'CDTMTT', 'active_yn' => 'y'],
            ]],
            ['id' => 3, 'name' => 'Hệ Thống', 'code' => 'HTTM', 'active_yn' => 'y', 'sub_modules' => [
                ['id' => 15, 'name' => 'Quản Trị Viên', 'code' => 'HTTMQT', 'active_yn' => 'y'],
                ['id' => 16, 'name' => 'Cài Đặt Hệ Thống', 'code' => 'HTTMCD', 'active_yn' => 'y'],
            ]],
        ];
        $this->modules = $modules;
        return view('livewire.admin.Mac.edit-mac', ['modules' => $this->modules]);
    }
}
