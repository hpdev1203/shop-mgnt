<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\ImportProduct;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\ImportProductDetail;
use App\Models\ProductDetail;
use App\Models\ProductSize;

class EditImportProduct extends Component
{
    public $id;
    public $import_product_code = "";
    public $import_product_name = "";
    public $warehouse_id = "";
    public $list_import_product_detail = [];
    public $product_id = [];
    public $product_detail_id = [];
    public $size_id = [];
    public $import_product_detail_qnty = [];
    public $import_product_detail_count = 0;
    public $product_detail_list;
    public $product_size_list;
    
    public function addImportProductDetail(){
        $new_import_product_detail = new ImportProductDetail();
        $this->list_import_product_detail[] = $new_import_product_detail;
        $this->import_product_detail_count++;
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

    public function updateImportProduct()
    {
        $this->validate([
            'import_product_code' => 'required|unique:import_product,code,' . $this->id,
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
        $import_product = ImportProduct::find($this->id);
        $import_product->code = $this->import_product_code;
        $import_product->name = $this->import_product_name;
        $import_product->warehouse_id = $this->warehouse_id;
        $import_product->save();
        
        if ($this->import_product_detail_count > 0) {
            for ($i=0; $i < $this->import_product_detail_count; $i++) {
                $this->list_import_product_detail[$i]->import_product_id = $import_product->id;
                $this->list_import_product_detail[$i]->product_id = $this->product_id[$i];
                $this->list_import_product_detail[$i]->product_detail_id = $this->product_detail_id[$i];
                if(isset($this->size_id[$i])){
                    if($this->size_id[$i] == ""){
                        $this->list_import_product_detail[$i]->size_id = NULL;
                    }else{
                        $this->list_import_product_detail[$i]->size_id = $this->size_id[$i];
                    }
                }
                $this->list_import_product_detail[$i]->quantity = $this->import_product_detail_qnty[$i];
                $this->list_import_product_detail[$i]->save();
            }
        }
        return redirect()->route('admin.import-product');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $import_product = ImportProduct::find($this->id);
        $this->import_product_code = $import_product->code;
        $this->import_product_name = $import_product->name;
        $this->warehouse_id = $import_product->warehouse_id;
        $import_product_details = ImportProductDetail::where('import_product_id',$this->id)->get();
        if(count($import_product_details) && $this->import_product_detail_count == 0){
            $this->import_product_detail_count = count($import_product_details);
            $this->list_import_product_detail = collect($import_product_details);
            foreach ($import_product_details as $index => $import_product_detail) {
                $this->product_id[$index] = $import_product_detail->product_id;
                $product_detail = ProductDetail::where('product_id',$this->product_id[$index])->get();
                $this->product_detail_list[$index] = $product_detail;
                $this->product_detail_id[$index] = $import_product_detail->product_detail_id;
                $product_size = ProductSize::where('product_id',$this->product_id[$index])->get();
                $this->product_size_list[$index] = $product_size;
                $this->size_id[$index] = $import_product_detail->size_id;
                $this->import_product_detail_qnty[$index] = $import_product_detail->quantity;
            }
        }
        $warehouses = Warehouse::All();
        $products = Product::All();
        return view('livewire.admin.inventory.edit-import-product', ['warehouses' => $warehouses, 'products' => $products, 'list_import_product_detail' => $this->list_import_product_detail, 'product_detail_list' => $this->product_detail_list , 'product_size_list' => $this->product_size_list]);
    }
}
