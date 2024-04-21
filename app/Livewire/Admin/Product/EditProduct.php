<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductDetail;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public $product_code;
    public $product_name;
    public $category_id;
    public $brand_id;
    public $product_retail_price = 0;
    public $product_wholesale_price = 0;
    public $product_description;
    public $product_detail_number = 1;
    public $product_detail_list;
    public $product_detail_image = [];
    public $product_detail_color = []; 
    public $product_detail_short_description = [];
    public $id;

    public function addProductDetail(){
        $new_product_detail = new ProductDetail();
        $this->product_detail_list->push($new_product_detail);
        $this->product_detail_number++;
    }

    public function removeProductDetail($index){
        $this->product_detail_list->forget($index);
        if(array_key_exists($index, $this->product_detail_image)){
            unset($this->product_detail_image[$index]);
        }
        if(array_key_exists($index, $this->product_detail_color)){
            unset($this->product_detail_color[$index]);
        }
        if(array_key_exists($index, $this->product_detail_short_description)){
            unset($this->product_detail_short_description[$index]);
        }
        $this->product_detail_list = $this->product_detail_list->values();
        $this->product_detail_image = array_values($this->product_detail_image);
        $this->product_detail_color = array_values($this->product_detail_color);
        $this->product_detail_short_description = array_values($this->product_detail_short_description);
        $this->product_detail_number--;
    }

    public function storeProduct(){
        $this->validate([
            'product_code' => 'required|unique:products,code,' . $this->id,
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

        $product = Product::find($this->id);
        $product->code = $this->product_code;
        $product->name = $this->product_name;
        $product->category_id = $this->category_id;
        $product->brand_id = $this->brand_id;
        $product->retail_price = $this->product_retail_price;
        $product->wholesale_price = $this->product_wholesale_price;
        $product->description = $this->product_description;
        $product->slug = \Illuminate\Support\Str::of($this->product_name)->slug('-');
        $product->save();
        
        for($i = 0; $i < $this->product_detail_number; $i++){
            $this->validate([
                'product_detail_image.'.$i => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'product_detail_color.'.$i => 'required',
                'product_detail_short_description.'.$i => 'required',
            ], [
                'product_detail_image.'.$i.'.required' => 'Hình ảnh là bắt buộc.',
                'product_detail_image.'.$i.'.image' => 'Hình ảnh phải là hình ảnh.',
                'product_detail_image.'.$i.'.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif, svg.',
                'product_detail_image.'.$i.'.max' => 'Hình ảnh không được lớn hơn 2MB.',
                'product_detail_color.'.$i.'.required' => 'Màu sắc là bắt buộc.',
                'product_detail_short_description.'.$i.'.required' => 'Mô tả ngắn là bắt buộc.',
            ]);

            $product_detail = ProductDetail::where('product_id', $this->id)->skip($i)->first();
            if(!$product_detail){
                $product_detail = new ProductDetail();
                $product_detail->product_id = $this->id;
            }
            
            $product_detail->image = $this->product_detail_image[$i]->store('product_detail_images', 'public');
            $product_detail->color = $this->product_detail_color[$i];
            $product_detail->short_description = $this->product_detail_short_description[$i];
            $product_detail->save();
        }

        session()->flash('message', 'Product has been created successfully!');
        return redirect()->route('admin.products');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $product = Product::find($this->id);
        $brands = Brand::all();
        $categories = Category::all();

        $this->product_code = $product->code;
        $this->product_name = $product->name;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->product_retail_price = $product->retail_price;
        $this->product_wholesale_price = $product->wholesale_price;
        $this->product_description = $product->description;

        $product_details = ProductDetail::where('product_id', $this->id)->get();
        $this->product_detail_list = $product_details;
        $this->product_detail_number = count($product_details);
        foreach ($product_details as $key => $product_detail) {
            $this->product_detail_image[$key] = $product_detail->image;
            $this->product_detail_color[$key] = $product_detail->color;
            $this->product_detail_short_description[$key] = $product_detail->short_description;
        }
        return view('livewire.admin.product.edit-product', ['brands' => $brands, 'categories' => $categories, 'product_detail_list' => $this->product_detail_list, 'product_detail_image_list' => $this->product_detail_image, 'product_description' => $this->product_description]);
    }
}
