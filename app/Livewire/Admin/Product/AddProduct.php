<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductDetail;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

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
    public $product_uom = 'Cái';
    public $product_size = '';
    public $product_size_list = [];
    public $product_detail_number = 0;
    public $product_detail_list = [];
    public $product_detail_image = [];
    public $product_detail_image_list = [];
    public $product_detail_title = []; 
    public $product_detail_short_description = [];
    public $brands;
    public $categories;
    public $is_active = '1';

    public function mount($brands, $categories)
    {
        $this->brands = $brands;
        $this->categories = $categories;
    }

    public function addProductSize(){
        $this->validate([
            'product_size' => 'required'
        ], [
            'product_size.required' => 'Kích thước không được để trống.'
        ]);
        $this->product_size_list[] = ["size" => $this->product_size];
        $this->product_size = '';
    }

    public function removeProductSize($index){
        unset($this->product_size_list[$index]);
        $this->product_size_list = array_values($this->product_size_list);
    }

    public function addProductDetail(){
        $new_product_detail = new ProductDetail();
        $this->product_detail_list[] = $new_product_detail;
        $this->product_detail_number++;
    }

    public function removeProductDetail($index){
        unset($this->product_detail_list[$index]);
        $this->product_detail_list = array_values($this->product_detail_list);

        if(array_key_exists($index, $this->product_detail_image_list)){
            unset($this->product_detail_image_list[$index]);
            $this->product_detail_image_list = array_values($this->product_detail_image_list);
        }
        if(array_key_exists($index, $this->product_detail_short_description)){
            unset($this->product_detail_short_description[$index]);
            $this->product_detail_short_description = array_values($this->product_detail_short_description);
        }

        if(array_key_exists($index, $this->product_detail_title)){
            unset($this->product_detail_title[$index]);
            $this->product_detail_title = array_values($this->product_detail_title);
        }
        
        $this->product_detail_number--;
    }

    public function removeProductDetailImage($index, $image_index){
        unset($this->product_detail_image_list[$index][$image_index]);
        $this->product_detail_image_list[$index] = array_values($this->product_detail_image_list[$index]);
    }

    public function storeProduct(){
        $this->validate([
            'product_code' => 'required|unique:products,code',
            'product_name' => 'required|unique:products,name',
            'product_retail_price' => 'required|numeric',
            'product_wholesale_price' => 'required|numeric',
            'product_uom' => 'required',
        ], [
            'product_code.required' => 'Mã sản phẩm là bắt buộc.',
            'product_code.unique' => 'Mã sản phẩm đã tồn tại.',
            'product_name.required' => 'Tên sản phẩm là bắt buộc.',
            'product_name.unique' => 'Tên sản phẩm đã tồn tại.',
            'product_retail_price.required' => 'Giá bán lẻ là bắt buộc.',
            'product_retail_price.numeric' => 'Giá bán lẻ phải là số.',
            'product_wholesale_price.required' => 'Giá bán sỉ là bắt buộc.',
            'product_wholesale_price.numeric' => 'Giá bán sỉ phải là số.',
            'product_uom.required' => 'Đơn vị tính là bắt buộc.'
        ]);

        for($i = 0; $i < $this->product_detail_number; $i++){
            $this->validate([
                'product_detail_title.'.$i => 'required'
            ], [
                'product_detail_title.'.$i.'.required' => 'Tiêu đề là bắt buộc.'
            ]);
        }

        $product = new Product();
        $product->code = $this->product_code;
        $product->name = $this->product_name;
        $product->category_id = $this->category_id;
        $product->brand_id = $this->brand_id;
        $product->retail_price = $this->product_retail_price;
        $product->wholesale_price = $this->product_wholesale_price;
        $product->description = $this->product_description;
        $product->slug = Str::of($this->product_name)->slug('-');
        $product->uom = $this->product_uom;
        $product->is_active =  $this->is_active;
        $product->save();
       
        foreach($this->product_size_list as $size){
            $product_size = new ProductSize();
            $product_size->product_id = $product->id;
            $product_size->size = $size['size'];
            $product_size->save();
        }

        for($i = 0; $i < $this->product_detail_number; $i++){
            $this->product_detail_list[$i]->title = $this->product_detail_title[$i];
            if(array_key_exists($i, $this->product_detail_short_description)){
                $this->product_detail_list[$i]->short_description = $this->product_detail_short_description[$i];
            }
            $this->product_detail_list[$i]->product_id = $product->id;
            $this->product_detail_list[$i]->retail_price = $product->retail_price;
            $this->product_detail_list[$i]->wholesale_price = $product->wholesale_price;

            if(array_key_exists($i, $this->product_detail_image_list)){
                $image_list = $this->product_detail_image_list[$i];
                $images_store = [];
                if(count($image_list) > 0){
                    foreach($image_list as $image){
                        $image_name = time() . uniqid() . '.' . $image->extension();
                        
                        $image->storeAs(path: "public\images\products", name: $image_name);
                        $images_store[] = $image_name;
                    }
                    $this->product_detail_list[$i]->image = json_encode($images_store);
                }
            }

            $this->product_detail_list[$i]->save();
        }
        session()->flash('message', 'Product has been created successfully!');
        return redirect()->route('admin.products');
    }

    public function generateProductCode(){
        $id_latest = Product::latest('id')->first();
        if($id_latest == null){
            $id_latest = (object) ['id' => 0];
        }   
        $this->product_code = 'PROD-'.str_pad($id_latest->id + 1, 4, '0', STR_PAD_LEFT);
    }

    public function initinalRender(){
        if($this->product_detail_number == 0){
            $new_product_detail = new ProductDetail();
            $new_product_detail->title = "Mặc định";
            $this->product_detail_title[0] = "Mặc định";
            $this->product_detail_list[] = $new_product_detail;
            $this->product_detail_number++;
        }
        for($i = 0; $i < count($this->product_detail_image); $i++){
            if(array_key_exists($i,$this->product_detail_image)){
                if(array_key_exists($i,$this->product_detail_image_list)){
                    $this->product_detail_image_list[$i] = array_merge($this->product_detail_image_list[$i], $this->product_detail_image[$i]);
                }else{
                    $this->product_detail_image_list[$i] = $this->product_detail_image[$i];
                }
            }else{
                $this->product_detail_image_list[$i] = [];
            }
            $this->product_detail_image[$i] = [];
        }
    }

    public function render()
    {
        $this->generateProductCode();
        $this->initinalRender();
        return view('livewire.admin.product.add-product', ['brands' => $this->brands, 'categories' => $this->categories, 'product_detail_list' => $this->product_detail_list, 'product_detail_image_list' => $this->product_detail_image_list]);
    }
}
