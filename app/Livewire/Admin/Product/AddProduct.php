<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class AddProduct extends Component
{
    public $product_code;
    public $product_name;
    public $category_id;
    public $brand_id;
    public $product_retail_price;
    public $product_wholesale_price;
    public $product_description;

    public function storeProduct(){
        $this->validate([
            'product_code' => 'required|unique:products,code',
            'product_name' => 'required',
            'product_retail_price' => 'required|numeric',
            'product_wholesale_price' => 'required|numeric',
        ], [
            'product_code.required' => 'Mã sản phẩm là bắt buộc.',
            'product_code.unique' => 'Mã sản phẩm đã tồn tại.',
            'product_name.required' => 'Tên sản phẩm là bắt buộc.',
            'product_retail_price.required' => 'Giá bán lẻ là bắt buộc.',
            'product_retail_price.numeric' => 'Giá bán lẻ phải là số.',
            'product_wholesale_price.required' => 'Giá bán sỉ là bắt buộc.',
            'product_wholesale_price.numeric' => 'Giá bán sỉ phải là số.',
        ]);

        $product = new Product();
        $product->code = $this->product_code;
        $product->name = $this->product_name;
        $product->category_id = $this->category_id;
        $product->brand_id = $this->brand_id;
        $product->retail_price = $this->product_retail_price;
        $product->wholesale_price = $this->product_wholesale_price;
        $product->description = $this->product_description;
        $product->slug = \Illuminate\Support\Str::of($this->product_name)->slug('-');
        $product->save();

        session()->flash('message', 'Product has been created successfully!');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $id_latest = Product::latest('id')->first();
        $this->product_code = 'PROD-'.str_pad($id_latest->id + 1, 4, '0', STR_PAD_LEFT);
        $brands = Brand::all();
        $categories = Category::all();
        return view('livewire.admin.product.add-product', ['brands' => $brands, 'categories' => $categories]);
    }
}
