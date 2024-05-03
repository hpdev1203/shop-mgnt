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
use Illuminate\Support\Facades\DB;

class BrandReport extends Component
{

    public $startdate = "";
    public $endate = "";    

    public function updateBrand()
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
      
        if(request()->brandId == '' && request()->categoryID == ''){
            $products = Product::with(['productDetails' => function ($query) {
                $query->where('image', '!=', null)->take(1);
            }])->paginate(10000);
        } else {
            $products = Product::where('category_id', '=', request()->categoryID)->orWhere('brand_id', '=', request()->brandId)->with(['productDetails' => function ($query) {
                $query->where('image', '!=', null)->take(1);
            }])->paginate(10000);
        }

        
        return view('livewire.admin.report.brand-report', ['products' => $products]);
    }
}
