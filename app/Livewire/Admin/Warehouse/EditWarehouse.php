<?php

namespace App\Livewire\Admin\Warehouse;

use Livewire\Component;
use App\Models\Warehouse;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class EditWarehouse extends Component
{
    use WithFileUploads;

    public $warehouse_code = '';
    public $warehouse_name = '';
    public $description = '';
    public $id;
    public $photo;
    public $existedPhoto;
    public $warehouse_address = '';
    public $warehouse_phone = '';

    public function updateWarehouse()
    {
        $this->validate([
            'warehouse_code' => 'required|unique:warehouse,code,' . $this->id,
            'warehouse_name' => 'required|unique:warehouse,name,' . $this->id,
        ], [
            'warehouse_code.required' => 'Mã kho hàng là bắt buộc.',
            'warehouse_code.unique' => 'Mã kho hàng đã tồn tại.',
            'warehouse_name.required' => 'Tên kho hàng là bắt buộc.',
            'warehouse_name.unique' => 'Tên kho hàng đã tồn tại.',
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
            $this->photo->storeAs(path: "public\images\warehouse", name: $photo_name);
        }
        $warehouse = Warehouse::find($this->id);
        $warehouse->code = $this->warehouse_code;
        $warehouse->name = $this->warehouse_name;
        $warehouse->address = $this->warehouse_address;
        $warehouse->phone = $this->warehouse_phone;
        //$warehouse->slug = Str::of($this->warehouse_name)->slug('-');
        if ($this->photo) {
            $warehouse->logo = $photo_name;
        }
        $warehouse->save();

        session()->flash('message', 'warehouse has been updated successfully!');
        return redirect()->route('admin.warehouses');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $categories = Warehouse::all();
        $warehouse = Warehouse::find($this->id);
        $this->warehouse_code = $warehouse->code;
        $this->warehouse_name = $warehouse->name;
        $this->warehouse_address = $warehouse->address;
        $this->warehouse_phone = $warehouse->phone;
       
        $audit = $warehouse->audits()->latest()->first();
        //dd($audit->getModified());

        //$this->description = $warehouse->description;
        if($warehouse->logo) {
            $this->existedPhoto = "images/warehouse/" . $warehouse->logo;
        }
        return view('livewire.admin.warehouse.edit-warehouse', ['categories' => $categories]);
    }
}
