<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductDetail;
use Livewire\WithFileUploads;

class AddProduct extends Component
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
        
        for($i = 0; $i < $this->product_detail_number; $i++){
            if(array_key_exists($i, $this->product_detail_image)){
                $image = $this->product_detail_image[$i];
                $image_name = time() . '.' . $image->extension();
                $this->product_detail_list[$i]->image = $image_name;
                $image->storeAs(path: "public\images\products", name: $image_name);
            }
            
            $this->product_detail_list[$i]->color = $this->product_detail_color[$i];
            $this->product_detail_list[$i]->color_code = $this->product_detail_color[$i];
            $this->product_detail_list[$i]->short_description = $this->product_detail_short_description[$i];
            $this->product_detail_list[$i]->product_id = $product->id;
            $this->product_detail_list[$i]->retail_price = $product->retail_price;
            $this->product_detail_list[$i]->wholesale_price = $product->wholesale_price;
            $this->product_detail_list[$i]->save();
        }

        session()->flash('message', 'Product has been created successfully!');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $id_latest = Product::latest('id')->first();
        if($id_latest == null){
            $id_latest = (object) ['id' => 0];
        }   
        $this->product_code = 'PROD-'.str_pad($id_latest->id + 1, 4, '0', STR_PAD_LEFT);
        $brands = Brand::all();
        $categories = Category::all();
        if($this->product_detail_number == 1){
            $new_product_detail = new ProductDetail();
            $this->product_detail_list = collect([$new_product_detail]);
        }
        return view('livewire.admin.product.add-product', ['brands' => $brands, 'categories' => $categories, 'product_detail_list' => $this->product_detail_list, 'product_detail_image_list' => $this->product_detail_image]);
    }
}
