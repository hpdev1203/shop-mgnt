<?php

namespace App\Livewire\Admin\Report;

use Livewire\Component;
use Illuminate\Support\Str;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use App\Models\Warehouse;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Models\ImportProduct;
use App\Models\ImportProductDetails;


class RevenueReport extends Component
{

    public function updateRevenue()
    {
       
        session()->flash('message', 'brand has been updated successfully!');
        return redirect()->route('admin.brands');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        // $categories = RevenueReport::all();
        // $brand = RevenueReport::find($this->id);
        // $this->brand_code = $brand->code;
        // $this->brand_name = $brand->name;
        // $this->description = $brand->description;
        // if($brand->logo) {
        //     $this->existedPhoto = "images/brands/" . $brand->logo;
        // }
        if(request()->brandId == '' && request()->categoryID == ''){
            $products = Product::with(['productDetails' => function ($query) {
                $query->where('image', '!=', null)->take(1);
            }])->paginate(10);
        } else {
            $products = Product::where('category_id', '=', request()->categoryID)->orWhere('brand_id', '=', request()->brandId)->with(['productDetails' => function ($query) {
                $query->where('image', '!=', null)->take(1);
            }])->paginate(10);
        }

        
        return view('livewire.admin.report.inventory-report', ['products' => $products]);
    }
}
