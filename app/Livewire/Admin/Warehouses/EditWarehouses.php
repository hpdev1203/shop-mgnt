<?php

namespace App\Livewire\Admin\Warehouses;

use Livewire\Component;
use App\Models\Warehouses;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class EditWarehouses extends Component
{
    use WithFileUploads;

    public $warehouses_code = '';
    public $warehouses_name = '';
    public $description = '';
    public $id;
    public $photo;
    public $existedPhoto;
    public $warehouses_address = '';
    public $warehouses_phone = '';

    public function updateWarehouses()
    {
        $this->validate([
            'warehouses_code' => 'required|unique:warehouses,code,' . $this->id,
            'warehouses_name' => 'required|unique:warehouses,name,' . $this->id,
        ], [
            'warehouses_code.required' => 'Mã nhãn hàng là bắt buộc.',
            'warehouses_code.unique' => 'Mã nhãn hàng đã tồn tại.',
            'warehouses_name.required' => 'Tên nhãn hàng là bắt buộc.',
            'warehouses_name.unique' => 'Tên nhãn hàng đã tồn tại.',
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
            $this->photo->storeAs(path: "public\images\warehouses", name: $photo_name);
        }
        $warehouses = Warehouses::find($this->id);
        $warehouses->code = $this->warehouses_code;
        $warehouses->name = $this->warehouses_name;
        $warehouses->address = $this->warehouses_address;
        $warehouses->phone = $this->warehouses_phone;
        //$warehouses->slug = Str::of($this->warehouses_name)->slug('-');
        if ($this->photo) {
            $warehouses->logo = $photo_name;
        }
        $warehouses->save();

        session()->flash('message', 'warehouses has been updated successfully!');
        return redirect()->route('admin.warehouses');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $categories = Warehouses::all();
        $warehouses = Warehouses::find($this->id);
        $this->warehouses_code = $warehouses->code;
        $this->warehouses_name = $warehouses->name;
        $this->warehouses_address = $warehouses->address;
        $this->warehouses_phone = $warehouses->phone;

        //$this->description = $warehouses->description;
        if($warehouses->logo) {
            $this->existedPhoto = "images/warehouses/" . $warehouses->logo;
        }
        return view('livewire.admin.warehouses.edit-warehouses', ['categories' => $categories]);
    }
}
