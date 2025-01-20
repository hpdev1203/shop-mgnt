<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class AddBrand extends Component
{
    use WithFileUploads;

    public $brand_code = '';
    public $brand_name = '';
    public $description = '';
    public $photo;
    public $existedPhoto;

    public function storeBrand()
    {
        $this->validate([
            'brand_code' => 'required|unique:brands,code',
            'brand_name' => 'required|unique:brands,name',
        ], [
            'brand_code.required' => 'Mã Thể Loại là bắt buộc.',
            'brand_code.unique' => 'Mã Thể Loại đã tồn tại.',
            'brand_name.required' => 'Tên Thể Loại là bắt buộc.',
            'brand_name.unique' => 'Tên Thể Loại đã tồn tại.',
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
            $this->photo->storeAs(path: "public\images\brands", name: $photo_name);
        }
        $brand = new Brand();
        $brand->code = $this->brand_code;
        $brand->name = $this->brand_name;
        $brand->description = $this->description;
        $brand->slug = Str::of($this->brand_name)->slug('-');
        if ($this->photo) {
            $brand->logo = $photo_name;
        }
        $brand->save();

        session()->flash('message', 'Brand has been created successfully!');
        return redirect()->route('admin.brands');
    }
    public function render()
    {
        $brands = Brand::all();
        return view('livewire.admin.brand.add-brand', ['brands' => $brands]);
    }
}
