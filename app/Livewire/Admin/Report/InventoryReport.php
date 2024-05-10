<?php

namespace App\Livewire\Admin\Report;

use Livewire\Component;
use Illuminate\Support\Str;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;


class InventoryReport extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        if(request()->brandId == '' && request()->categoryID == ''){
            $products = Product::select(
                'products.id','products.code','products.name',
                'products.category_id','products.brand_id','products.retail_price',
                'products.wholesale_price'
            )->join('import_product_detail','products.id','import_product_detail.product_id')
            ->groupBy(
                'products.id','products.code','products.name',
                'products.category_id','products.brand_id','products.retail_price',
                'products.wholesale_price'
            )->paginate(20);
        } else {
            if(request()->brandId != '' && request()->categoryID != ''){
                $products = Product::select(
                    'products.id','products.code','products.name',
                    'products.category_id','products.brand_id','products.retail_price',
                    'products.wholesale_price'
                )->join('import_product_detail','products.id','import_product_detail.product_id')
                ->where('products.category_id', '=', request()->categoryID)
                ->where('products.brand_id', '=', request()->brandId)
                ->groupBy(
                    'products.id','products.code','products.name',
                    'products.category_id','products.brand_id','products.retail_price',
                    'products.wholesale_price'
                )->paginate(20);
            }else{
                $products = Product::select(
                    'products.id','products.code','products.name',
                    'products.category_id','products.brand_id','products.retail_price',
                    'products.wholesale_price'
                )->join('import_product_detail','products.id','import_product_detail.product_id')
                ->where('products.category_id', '=', request()->categoryID)
                ->orWhere('products.brand_id', '=', request()->brandId)
                ->groupBy(
                    'products.id','products.code','products.name',
                    'products.category_id','products.brand_id','products.retail_price',
                    'products.wholesale_price'
                )->paginate(20);
            }
        }

        
        return view('livewire.admin.report.inventory-report', ['products' => $products]);
    }
}
