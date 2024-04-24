<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\TransferWarehouse;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\TransferWarehouseDetail;
use App\Models\ProductDetail;
use App\Models\ProductSize;

class EditTransferWarehouse extends Component
{
    public $id;
    public $transfer_warehouse_code = "";
    public $transfer_warehouse_name = "";
    public $from_warehouse_id = "";
    public $to_warehouse_id = "";
    public $list_transfer_warehouse_detail = [];
    public $product_id = [];
    public $product_detail_id = [];
    public $size_id = [];
    public $transfer_warehouse_detail_qnty = [];
    public $transfer_warehouse_detail_count = 0;
    public $product_detail_list;
    public $product_size_list;
    
    public function addTransferWarehouseDetail(){
        $new_transfer_warehouse_detail = new TransferWarehouseDetail();
        $this->list_transfer_warehouse_detail[] = $new_transfer_warehouse_detail;
        $this->transfer_warehouse_detail_count++;
    }

    public function pullDropdown($index){
        $product_id = $this->product_id[$index];
        $product_detail = ProductDetail::where('product_id',$product_id)->get();
        $product_size = ProductSize::where('product_id',$product_id)->get();
        $this->product_detail_list[$index] = $product_detail;
        $this->product_size_list[$index] = $product_size;
    }

    public function updateTransferWarehouse()
    {
        $this->validate([
            'transfer_warehouse_code' => 'required|unique:transfer_product,code,' .$this->id,
            'transfer_warehouse_name' => 'required',
            'from_warehouse_id' => 'required',
            'to_warehouse_id' => 'required',
        ], [
            'transfer_warehouse_code.required' => 'Vui lòng nhập mã chuyển kho.',
            'transfer_warehouse_code.unique' => 'Mã chuyển kho đã tồn tại.',
            'transfer_warehouse_name.required' => 'Vui lòng nhập tiêu đề.',
            'from_warehouse_id.required' => 'Vui lòng chọn kho hàng đi.',
            'to_warehouse_id.required' => 'Vui lòng chọn kho hàng đến.',
        ]);

        if ($this->transfer_warehouse_detail_count > 0) {
            for ($i=0; $i < $this->transfer_warehouse_detail_count; $i++) {
                $this->validate([
                    'product_id.'.$i => 'required',
                    'product_detail_id.'.$i => 'required',
                    'size_id.'.$i => 'required',
                    'transfer_warehouse_detail_qnty.'.$i => 'required',
                ], [
                    'product_id.'.$i => 'Vui lòng chọn sản phẩm',
                    'product_detail_id.'.$i => 'Vui lòng chọn mẫu sản phẩm',
                    'size_id.'.$i => 'Vui lòng chọn size',
                    'transfer_warehouse_detail_qnty.'.$i => 'Vui lòng nhập số lượng',
                ]);
            }
        }
        $transfer_warehouse = TransferWarehouse::find($this->id);
        $transfer_warehouse->code = $this->transfer_warehouse_code;
        $transfer_warehouse->name = $this->transfer_warehouse_name;
        $transfer_warehouse->from_warehouse_id = $this->from_warehouse_id;
        $transfer_warehouse->to_warehouse_id = $this->to_warehouse_id;
        $transfer_warehouse->save();
        
        if ($this->transfer_warehouse_detail_count > 0) {
            for ($i=0; $i < $this->transfer_warehouse_detail_count; $i++) { 
                $this->list_transfer_warehouse_detail[$i]->transfer_product_id = $transfer_warehouse->id;
                $this->list_transfer_warehouse_detail[$i]->product_id = $this->product_id[$i];
                $this->list_transfer_warehouse_detail[$i]->product_detail_id = $this->product_detail_id[$i];
                $this->list_transfer_warehouse_detail[$i]->size_id = $this->size_id[$i];
                $this->list_transfer_warehouse_detail[$i]->quantity = $this->transfer_warehouse_detail_qnty[$i];
                $this->list_transfer_warehouse_detail[$i]->save();
            }
        }
        return redirect()->route('admin.transfer-warehouse');
    }

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $transfer_warehouse = TransferWarehouse::find($this->id);
        $this->transfer_warehouse_code = $transfer_warehouse->code;
        $this->transfer_warehouse_name = $transfer_warehouse->name;
        $this->from_warehouse_id = $transfer_warehouse->from_warehouse_id;
        $this->to_warehouse_id = $transfer_warehouse->to_warehouse_id;
        $transfer_warehouse_details = TransferWarehouseDetail::where('transfer_product_id',$this->id)->get();
        if(count($transfer_warehouse_details) && $this->transfer_warehouse_detail_count == 0){
            $this->transfer_warehouse_detail_count = count($transfer_warehouse_details);
            $this->list_transfer_warehouse_detail = collect($transfer_warehouse_details);
            foreach ($transfer_warehouse_details as $index => $transfer_warehouse_detail) {
                $this->product_id[$index] = $transfer_warehouse_detail->product_id;
                $product_detail = ProductDetail::where('product_id',$this->product_id[$index])->get();
                $this->product_detail_list[$index] = $product_detail;
                $this->product_detail_id[$index] = $transfer_warehouse_detail->product_detail_id;
                $product_size = ProductDetail::where('product_id',$this->product_id[$index])->get();
                $this->product_size_list[$index] = $product_size;
                $this->size_id[$index] = $transfer_warehouse_detail->size_id;
                $this->transfer_warehouse_detail_qnty[$index] = $transfer_warehouse_detail->quantity;
            }
        }
        $warehouses = Warehouse::All();
        $products = Product::All();
        return view('livewire.admin.inventory.edit-transfer-warehouse', ['warehouses' => $warehouses, 'products' => $products, 'list_transfer_warehouse_detail' => $this->list_transfer_warehouse_detail, 'product_detail_list' => $this->product_detail_list , 'product_size_list' => $this->product_size_list]);
    }
}
