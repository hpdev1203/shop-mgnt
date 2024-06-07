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
use App\Models\OrderDetail;

class AddTransferWarehouse extends Component
{
    public $transfer_warehouse_code = "";
    public $transfer_warehouse_name = "";
    public $from_warehouse_id = "";
    public $to_warehouse_id = "";
    public $product_id = [];
    public $product_detail_id = [];
    public $size_id = [];
    public $transfer_warehouse_detail_qnty = [];
    public $transfer_warehouse_detail_count = 0;
    public $product_detail_list;
    public $product_size_list;
    public $disabled_select_yn = [];

    public function addTransferWarehouseDetail(){
        $this->transfer_warehouse_detail_count++;
    }

    public function copyTransferWarehouseDetail($index){
        $this->transfer_warehouse_detail_count++;
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
            
            $firstSizeId = array_slice($this->size_id, 0, $index+1);
            $secondSizeId = array_slice($this->size_id, $index+1);
            $this->size_id = array_merge($firstSizeId, [$this->size_id[$index]], $secondSizeId);
           
            $product_id_merge = $this->product_id[$index];
            for ($i=$index; $i <= $this->transfer_warehouse_detail_count; $i++) {
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
            $this->disabled_select_yn[$this->transfer_warehouse_detail_count] = "n";
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

    public function storeTransferWarehouse()
    {
        $this->validate([
            'transfer_warehouse_code' => 'required|unique:transfer_product,code',
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

        if ($this->transfer_warehouse_detail_count == 0) {
            $this->dispatch('successTransferProduct', [
                'title' => 'Thất bại',
                'message' => 'Bạn chưa chọn sản phẩm, vui lòng nhập lại.',
                'type' => 'error',
                'timeout' => 3000
            ]);
            return;
        }

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
                    'product_detail_id.'.$i.'.exists' => 'Mẫu sản phẩm chưa được nhập hàng',
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
                $quantity_order[$i] = 0;
                if(isset($this->product_detail_id[$i])){
                    if (count($product_size[$i]) > 0){
                        $import_product_quantity[$i] = ImportProductDetail::select('product_id','product_detail_id','size_id',ImportProductDetail::raw('SUM(quantity) as quantity'))->where([
                            ['product_id',$this->product_id[$i]],
                            ['product_detail_id',$this->product_detail_id[$i]],
                            ['size_id',$this->size_id[$i]],
                        ])->groupBy('product_id','product_detail_id','size_id')->first();
                        $tranfer_warehouse_quantity[$i] = TransferWarehouseDetail::select('product_id','product_detail_id','size_id',TransferWarehouseDetail::raw('SUM(quantity) as quantity'))->where([
                            ['product_id',$this->product_id[$i]],
                            ['product_detail_id',$this->product_detail_id[$i]],
                            ['size_id',$this->size_id[$i]],
                        ])->groupBy('product_id','product_detail_id','size_id')->first();
                        if(isset($this->from_warehouse_id)){
                            $order_quantity[$i] = OrderDetail::select('product_id','product_detail_id','size_id','warehouse_id',OrderDetail::raw('SUM(quantity) as quantity'))->where([
                                ['product_id',$this->product_id[$i]],
                                ['product_detail_id',$this->product_detail_id[$i]],
                                ['size_id',$this->size_id[$i]],
                                ['warehouse_id',$this->from_warehouse_id],
                            ])->groupBy('product_id','product_detail_id','size_id','warehouse_id')->first();
                            if (isset($order_quantity[$i]->quantity)) {
                                $quantity_order[$i] = (int)$order_quantity[$i]->quantity;
                            }
                        }
                    }else{
                        $import_product_quantity[$i] = ImportProductDetail::select('product_id','product_detail_id',ImportProductDetail::raw('SUM(quantity) as quantity'))->where([
                            ['product_id',$this->product_id[$i]],
                            ['product_detail_id',$this->product_detail_id[$i]],
                        ])->groupBy('product_id','product_detail_id')->first();
                        $tranfer_warehouse_quantity[$i] = TransferWarehouseDetail::select('product_id','product_detail_id',TransferWarehouseDetail::raw('SUM(quantity) as quantity'))->where([
                            ['product_id',$this->product_id[$i]],
                            ['product_detail_id',$this->product_detail_id[$i]],
                        ])->groupBy('product_id','product_detail_id')->first();
                        if(isset($this->from_warehouse_id)){
                            $order_quantity[$i] = OrderDetail::select('product_id','product_detail_id','size_id','warehouse_id',OrderDetail::raw('SUM(quantity) as quantity'))->where([
                                ['product_id',$this->product_id[$i]],
                                ['product_detail_id',$this->product_detail_id[$i]],
                                ['warehouse_id',$this->from_warehouse_id],
                            ])->groupBy('product_id','product_detail_id','size_id','warehouse_id')->first();
                            if (isset($order_quantity[$i]->quantity)) {
                                $quantity_order[$i] = (int)$order_quantity[$i]->quantity;
                            }
                        }
                    }
                    if (isset($import_product_quantity[$i]->quantity)) {
                        $quantity[$i] = (int)$import_product_quantity[$i]->quantity - $quantity_order[$i];
                        if (isset($tranfer_warehouse_quantity[$i]->quantity)) {
                            $quantity[$i] = $quantity[$i] - (int)$tranfer_warehouse_quantity[$i]->quantity;
                        }
                    }
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
                        $empty_product[$i] = ImportProductDetail::join('import_product' , 'import_product.id','=','import_product_detail.import_product_id')
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
        $transfer_warehouse = new TransferWarehouse();
        $transfer_warehouse->code = $this->transfer_warehouse_code;
        $transfer_warehouse->name = $this->transfer_warehouse_name;
        $transfer_warehouse->from_warehouse_id = $this->from_warehouse_id;
        $transfer_warehouse->to_warehouse_id = $this->to_warehouse_id;
        $transfer_warehouse->save();
        
        if ($this->transfer_warehouse_detail_count > 0) {
            for ($i=0; $i < $this->transfer_warehouse_detail_count; $i++) { 
                $transfer_warehouse_detail[$i] = new TransferWarehouseDetail();
                $transfer_warehouse_detail[$i]->transfer_product_id = $transfer_warehouse->id;
                $transfer_warehouse_detail[$i]->product_id = $this->product_id[$i];
                $transfer_warehouse_detail[$i]->product_detail_id = $this->product_detail_id[$i];
                if (isset($this->size_id[$i])) {
                    $transfer_warehouse_detail[$i]->size_id = $this->size_id[$i];
                }
                $transfer_warehouse_detail[$i]->quantity = $this->transfer_warehouse_detail_qnty[$i];
                $transfer_warehouse_detail[$i]->save();
            }
        }
        return redirect()->route('admin.transfer-warehouse');
    }

    public function render()
    {
        $id_latest = TransferWarehouse::all();
        $warehouses = Warehouse::all();
        $products = Product::all();
        $this->transfer_warehouse_code = 'TRA-'.str_pad(count($id_latest) + 1, 4, '0', STR_PAD_LEFT);
        return view('livewire.admin.inventory.add-transfer-warehouse',['warehouses' => $warehouses, 'products' => $products, 'product_detail_list' => $this->product_detail_list , 'product_size_list' => $this->product_size_list]);
    }
}
