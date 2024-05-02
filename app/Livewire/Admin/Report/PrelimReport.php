<?php

namespace App\Livewire\Admin\Report;

use Livewire\Component;
use Illuminate\Support\Str;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class PrelimReport extends Component
{
    public $brand_id = "";
    public $category_id = "";

    public function updatePrelim()
    {
        $id = request() -> id;
        $brandId = $this->brand_id;
        $categoryID = $this->category_id;

        
        session()->flash('message', 'prelim has been updated successfully!');
        return redirect()->route('admin.reports.inventory',['brandId'=>$brandId,'categoryID'=>$categoryID]);
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        // $categories = PrelimReport::all();
        // $brand = PrelimReport::find($this->id);
        // $this->brand_code = $brand->code;
        // $this->brand_name = $brand->name;
        // $this->description = $brand->description;
        // if($brand->logo) {
        //     $this->existedPhoto = "images/brands/" . $brand->logo;
        // }
        $id = request() -> id;
        $brands = Brand::all();
        $categorys = Category::all();

        return view('livewire.admin.report.prelim-report', ['id' => $id,'brands' => $brands,'categorys' => $categorys]);
    }
}
