<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Str;

class EditBrand extends Component
{
    public $brand_code = '';
    public $brand_name = '';
    public $description = '';
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $categories = Brand::all();
        $brand = Brand::find($this->id);
        $this->brand_code = $brand->code;
        $this->brand_name = $brand->name;
        $this->description = $brand->description;
        return view('livewire.admin.brand.edit-brand', ['categories' => $categories]);
    }

    public function updateBrand()
    {
        $this->validate([
            'brand_name' => 'required|unique:categories,name,' . $this->id
        ]);

        $brand = Brand::find($this->id);
        $brand->code = $this->brand_code;
        $brand->name = $this->brand_name;
        $brand->description = $this->description;
        $brand->slug = Str::of($this->brand_name)->slug('-');
        $brand->save();

        session()->flash('message', 'brand has been updated successfully!');
        return redirect()->route('admin.brands');
    }
}
