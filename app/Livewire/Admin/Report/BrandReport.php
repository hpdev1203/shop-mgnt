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
use Illuminate\Support\Facades\DB;

class BrandReport extends Component
{ 
    use WithPagination, WithoutUrlPagination;
    public function render()
    {
        if(request()->brandId == '' && request()->categoryID == ''){
            $products = Product::paginate(20);
        } else {
            if(request()->brandId != '' && request()->categoryID != ''){
                $products = Product::where('category_id', '=', request()->categoryID)->where('brand_id', '=', request()->brandId)->with(['productDetails' => function ($query) {
                    $query->where('image', '!=', null)->take(1);
                }])->paginate(20);
            }
            else{
                $products = Product::where('category_id', '=', request()->categoryID)->orWhere('brand_id', '=', request()->brandId)->with(['productDetails' => function ($query) {
                    $query->where('image', '!=', null)->take(1);
                }])->paginate(20);
            }
            
        }

        
        return view('livewire.admin.report.brand-report', ['products' => $products]);
    }
}
