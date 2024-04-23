<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\ImportProduct;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\ImportProductDetail;

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

    public function addImportProductDetail(){
        $this->list_import_product_detail[] = "";
        $this->import_product_detail_count++;
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
                $this->validate([
                    'product_id.'.$i => 'required',
                    'import_product_detail_qnty.'.$i => 'required',
                ], [
                    'product_id.'.$i => 'Vui lòng chọn sản phẩm',
                    'import_product_detail_qnty.'.$i => 'Vui lòng nhập số lượng',
                ]);
            }
        }
        $import_product = ImportProduct::find($this->id);
        $import_product->code = $this->import_product_code;
        $import_product->name = $this->import_product_name;
        $import_product->warehouse_id = $this->warehouse_id;
        $import_product->save();
        
        if ($this->import_product_detail_count > 0) {
            for ($i=0; $i < $this->import_product_detail_count; $i++) { 
                $import_product_detail[$i] = new ImportProductDetail();
                $import_product_detail[$i]->import_product_id = $import_product->id;
                $import_product_detail[$i]->product_id = $this->product_id[$i];
                $import_product_detail[$i]->product_detail_id =1;
                $import_product_detail[$i]->size_id =1;
                $import_product_detail[$i]->quantity = $this->import_product_detail_qnty[$i];
                $import_product_detail[$i]->save();
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
        if(count($import_product_details)){
            $this->import_product_detail_count = count($import_product_details);
            $this->list_import_product_detail = collect($import_product_details);
            foreach ($import_product_details as $index => $import_product_detail) {
                $this->product_id[$index] = $import_product_detail->product_id;
                $this->import_product_detail_qnty[$index] = $import_product_detail->quantity;
            }
        }
        $warehouses = Warehouse::All();
        $products = Product::All();
        return view('livewire.admin.inventory.edit-import-product', ['warehouses' => $warehouses, 'products' => $products, 'list_import_product_detail' => $this->list_import_product_detail]);
    }
}
