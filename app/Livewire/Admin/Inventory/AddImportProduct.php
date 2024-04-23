<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\ImportProduct;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\ImportProductDetail;

class AddImportProduct extends Component
{
    public $import_product_code = "";
    public $import_product_name = "";
    public $warehouse_id = "";
    public $list_import_product_detail = [];
    public $product_id = [];
    public $product_detail_id = [];
    public $size_id = [];
    public $import_product_detail_qnty = [];
    public $import_product_detail_count = 0;

    public function addImportProductDetail(){
        $this->list_import_product_detail[] = "";
        $this->import_product_detail_count++;
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

        if ($this->import_product_detail_count > 0) {
            for ($i=0; $i < $this->import_product_detail_count; $i++) {
                $this->validate([
                    'product_id.'.$i => 'required',
                    'import_product_detail_qnty.'.$i => 'required',
                ], [
                    'product_id.'.$i => 'Vui lòng chọn sản phẩm',
                    'import_product_detail_qnty.'.$i => 'Vui lòng nhập số lượng',
                ]);
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
                $import_product_detail[$i]->quantity = $this->import_product_detail_qnty[$i];
                $import_product_detail[$i]->save();
            }
        }
        return redirect()->route('admin.import-product');
    }

    public function render()
    {
        $id_latest = ImportProduct::latest('id')->first();
        if($id_latest == null){
            $id_latest = (object) ['id' => 0];
        }   
        $warehouses = Warehouse::all();
        $products = Product::all();
        $this->import_product_code = 'IMP-'.str_pad($id_latest->id + 1, 4, '0', STR_PAD_LEFT);
        return view('livewire.admin.inventory.add-import-product',['warehouses' => $warehouses, 'products' => $products, 'list_import_product_detail' => $this->list_import_product_detail]);
    }
}
