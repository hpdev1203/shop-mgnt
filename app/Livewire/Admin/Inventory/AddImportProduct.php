<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\ImportProduct;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\ImportProductDetail;
use App\Models\ProductDetail;
use App\Models\ProductSize;


class AddImportProduct extends Component
{
    public $import_product_code = "";
    public $import_product_name = "";
    public $warehouse_id = "";
    public $product_id = [];
    public $product_detail_id = [];
    public $size_id = [];
    public $import_product_detail_qnty = [];
    public $import_product_detail_count = 0;
    public $product_detail_list;
    public $product_size_list;
    public $disabled_select_yn = [];

    public function addImportProductDetail(){
        $this->import_product_detail_count++;
    }

    public function copyImportProductDetail($index){
        $this->import_product_detail_count++;
        if(isset($this->product_id[$index])){
            $firstProductId = array_slice($this->product_id, 0, $index+1);
            $secondProductId = array_slice($this->product_id, $index+1);
            $this->product_id = array_merge($firstProductId, [$this->product_id[$index]], $secondProductId);

            $firstProductDetailList = array_slice($this->product_detail_list, 0, $index+1);
            $secondProductDetailList = array_slice($this->product_detail_list, $index+1);
            $this->product_detail_list = array_merge($firstProductDetailList, [$this->product_detail_list[$index]], $secondProductDetailList);
            
            $firstProductDetailId = array_slice($this->product_detail_id, 0, $index+1);
            $secondProductDetailId = array_slice($this->product_detail_id, $index+1);
            $this->product_detail_id = array_merge($firstProductDetailId, [$this->product_detail_id[$index]], $secondProductDetailId);

            $firstSizeList = array_slice($this->product_size_list, 0, $index+1);
            $secondSizeList = array_slice($this->product_size_list, $index+1);
            $this->product_size_list = array_merge($firstSizeList, [$this->product_size_list[$index]], $secondSizeList);

            $product_id_merge = $this->product_id[$index];
            for ($i=$index; $i <= $this->import_product_detail_count; $i++) {
                if (isset($this->product_id[$i]) && $this->product_id[$i] == $product_id_merge) {
                    $this->disabled_select_yn[$i] = "y";
                }else{
                    $this->disabled_select_yn[$i - 1] = "n";
                    $this->disabled_select_yn[$i] = "y";
                    if(isset($this->product_id[$i])){
                        $product_id_merge = $this->product_id[$i];
                    }
                }
            }
            $this->disabled_select_yn[$this->import_product_detail_count] = "n";
        }
    }

    public function pullDropdown($index){
        $product_id = $this->product_id[$index];
        $this->product_detail_id[$index] = "";
        $this->size_id[$index] = "";
        $product_detail = ProductDetail::where('product_id',$product_id)->get();
        $product_size = ProductSize::where('product_id',$product_id)->get();
        $this->product_detail_list[$index] = $product_detail;
        $this->product_size_list[$index] = $product_size;
    }

    public function storeImportProduct()
    {
        $this->validate([
            'import_product_code' => 'required|unique:import_product,code',
            'import_product_name' => 'required',
            'warehouse_id' => 'required',
        ], [
            'import_product_code.required' => 'Vui lòng nhập mã nhập hàng.',
            'import_product_code.unique' => 'Mã nhập hàng đã tồn tại.',
            'import_product_name.required' => 'Vui lòng nhập tiêu đề.',
            'warehouse_id.required' => 'Vui lòng chọn kho hàng.',
        ]);

        if ($this->import_product_detail_count == 0) {
            $this->dispatch('successImportProduct', [
                'title' => 'Thất bại',
                'message' => 'Bạn chưa chọn sản phẩm, vui lòng nhập lại.',
                'type' => 'error',
                'timeout' => 3000
            ]);
            return;
        }

        if ($this->import_product_detail_count > 0) {
            for ($i=0; $i < $this->import_product_detail_count; $i++) {
                $product_size[$i] = 0;
                if(isset($this->product_id[$i])){
                    $product_size[$i] = ProductSize::where('product_id',$this->product_id[$i])->get();
                }
                $this->validate([
                    'product_id.'.$i => 'required',
                    'product_detail_id.'.$i => 'required',
                    'import_product_detail_qnty.'.$i => 'required',
                ], [
                    'product_id.'.$i => 'Vui lòng chọn sản phẩm',
                    'product_detail_id.'.$i => 'Vui lòng chọn mẫu sản phẩm',
                    'import_product_detail_qnty.'.$i => 'Vui lòng nhập số lượng',
                ]);
                if (count($product_size[$i]) > 0) {
                    $this->validate([
                        'size_id.'.$i => 'required',
                    ], [
                        'size_id.'.$i => 'Vui lòng chọn size',
                    ]);
                }
            }
        }
        $import_product = new ImportProduct();
        $import_product->code = $this->import_product_code;
        $import_product->name = $this->import_product_name;
        $import_product->warehouse_id = $this->warehouse_id;
        $import_product->save();
        
        if ($this->import_product_detail_count > 0) {
            for ($i=0; $i < $this->import_product_detail_count; $i++) { 
                $import_product_detail[$i] = new ImportProductDetail();
                $import_product_detail[$i]->import_product_id = $import_product->id;
                $import_product_detail[$i]->product_id = $this->product_id[$i];
                $import_product_detail[$i]->product_detail_id = $this->product_detail_id[$i];
                if(isset($this->size_id[$i])){
                    $import_product_detail[$i]->size_id = $this->size_id[$i];
                }
                $import_product_detail[$i]->quantity = $this->import_product_detail_qnty[$i];
                $import_product_detail[$i]->save();
            }
        }
        return redirect()->route('admin.import-product');
    }

    public function render()
    {
        $id_latest = ImportProduct::all(); 
        $warehouses = Warehouse::all();
        $products = Product::all();
        $this->import_product_code = 'IMP-'.str_pad(count($id_latest) + 1, 4, '0', STR_PAD_LEFT);
        return view('livewire.admin.inventory.add-import-product',['warehouses' => $warehouses, 'products' => $products, 'product_detail_list' => $this->product_detail_list , 'product_size_list' => $this->product_size_list , 'disabled_select_yn' => $this->disabled_select_yn]);
    }
}
