<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\TransferWarehouse;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\TransferWarehouseDetail;
use App\Models\ProductDetail;
use App\Models\ProductSize;
use App\Models\ImportProduct;
use App\Models\ImportProductDetail;

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
            'from_warehouse_id' => 'required|exists:import_product,warehouse_id',
            'to_warehouse_id' => 'required|different:from_warehouse_id',
        ], [
            'transfer_warehouse_code.required' => 'Vui lòng nhập mã chuyển kho.',
            'transfer_warehouse_code.unique' => 'Mã chuyển kho đã tồn tại.',
            'transfer_warehouse_name.required' => 'Vui lòng nhập tiêu đề.',
            'from_warehouse_id.required' => 'Vui lòng chọn kho hàng đi.',
            'from_warehouse_id.exists' => 'Kho hàng đi chưa có sản phẩm',
            'to_warehouse_id.required' => 'Vui lòng chọn kho hàng đến.',
            'to_warehouse_id.different' => 'Vui lòng chọn kho hàng đến khác với kho hàng đi.',
        ]);

        if ($this->transfer_warehouse_detail_count > 0) {
            for ($i=0; $i < $this->transfer_warehouse_detail_count; $i++) {
                $product_size[$i] = 0;
                if(isset($this->product_id[$i])){
                    $product_size[$i] = ProductSize::where('product_id',$this->product_id[$i])->get();
                }
                $this->validate([
                    'product_id.'.$i => 'required|exists:import_product_detail,product_id',
                    'product_detail_id.'.$i => 'required|exists:import_product_detail,product_detail_id',
                    'transfer_warehouse_detail_qnty.'.$i => 'required|gt:0',
                ], [
                    'product_id.'.$i.'.required' => 'Vui lòng chọn sản phẩm',
                    'product_id.'.$i.'.exists' => 'Sản phẩm chưa được nhập hàng',
                    'product_detail_id.'.$i.'.required' => 'Vui lòng chọn mẫu sản phẩm',
                    'product_detail_id.'.$i.'.exists' => 'Mẫu sản phẩm chưa được nhập',
                    'transfer_warehouse_detail_qnty.'.$i.'.required' => 'Vui lòng nhập số lượng',
                    'transfer_warehouse_detail_qnty.'.$i.'.gt' => 'Số lượng phải lớn hơn 0',
                ]);
                if (count($product_size[$i]) > 0) {
                    $this->validate([
                        'size_id.'.$i => 'required|exists:import_product_detail,size_id',
                    ], [
                        'size_id.'.$i.'.required' => 'Vui lòng chọn size',
                        'size_id.'.$i.'.exists' => 'Size chưa được nhập hàng',
                    ]);
                }
                $quantity[$i] = 0;
                if(isset($this->product_detail_id[$i])){
                    if (count($product_size[$i]) > 0){
                        $import_product_quantity[$i] = ImportProductDetail::select('product_id','product_detail_id','size_id',ImportProductDetail::raw('SUM(quantity) as quantity'))->where([
                            ['product_id',$this->product_id[$i]],
                            ['product_detail_id',$this->product_detail_id[$i]],
                            ['size_id',$this->size_id[$i]],
                        ])->groupBy('product_id','product_detail_id','size_id')->first();
                    }else{
                        $import_product_quantity[$i] = ImportProductDetail::select('product_id','product_detail_id',ImportProductDetail::raw('SUM(quantity) as quantity'))->where([
                            ['product_id',$this->product_id[$i]],
                            ['product_detail_id',$this->product_detail_id[$i]],
                        ])->groupBy('product_id','product_detail_id')->first();
                    }
                    $quantity[$i] = (int)$import_product_quantity[$i]->quantity;
                    if($quantity[$i] > 0){
                         $this->validate([
                            'transfer_warehouse_detail_qnty.'.$i => 'lte:'.$quantity[$i],
                        ], [
                            'transfer_warehouse_detail_qnty.'.$i.'.lte' => 'Số lượng nhỏ hơn hoặc bằng: '.$quantity[$i],
                        ]);
                    }
                }
                if(isset($this->from_warehouse_id)){
                    $empty_product[$i] = 0;
                    if(isset($this->product_id[$i])){
                        $empty_product[$i] = ImportProductDetail::join('import_product' , 'import_product.id','=','import_product_detail.product_id')
                            ->where('import_product.warehouse_id',$this->from_warehouse_id)
                            ->where('import_product_detail.product_id',$this->product_id[$i])
                            ->distinct()->get();
                        if(count($empty_product[$i]) == 0){
                            $this->validate([
                                'product_id.'.$i => 'in:'.$empty_product[$i],
                            ], [
                                'product_id.'.$i.'.in' => 'Sản phẩm không thuộc kho hàng đi',
                            ]);
                        }
                    }
                }
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
                if (isset($this->size_id[$i])) {
                    if($this->size_id[$i] == ""){
                        $this->list_transfer_warehouse_detail[$i]->size_id = NULL;
                    }else{
                        $this->list_transfer_warehouse_detail[$i]->size_id = $this->size_id[$i];
                    }
                }
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
                $product_size = ProductSize::where('product_id',$this->product_id[$index])->get();
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
