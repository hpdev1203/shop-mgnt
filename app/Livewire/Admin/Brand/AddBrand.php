<?php

namespace App\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brand;
use Illuminate\Support\Str;

class AddBrand extends Component
{
    public $brand_code = '';
    public $brand_name = '';
    public $description = '';

    public function storeBrand()
    {
        $this->validate([
            'brand_name' => 'required|unique:brands,name'
        ]);

        $brand = new Brand();
        $brand->code = $this->brand_code;
        $brand->name = $this->brand_name;
        $brand->description = $this->description;
        $brand->slug = Str::of($this->brand_name)->slug('-');
        $brand->save();

        session()->flash('message', 'brand has been created successfully!');
        return redirect()->route('admin.brands');
    }
    public function render()
    {
        $brands = Brand::all();
        return view('livewire.admin.brand.add-brand', ['brands' => $brands]);
    }
}
