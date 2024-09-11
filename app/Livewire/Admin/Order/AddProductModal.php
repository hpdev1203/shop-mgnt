<?php

namespace App\Livewire\Admin\Order;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\ProductDetail;
use App\Models\OrderDetail;
use App\Models\ProductSize;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\ImportProductDetail;
use App\Models\TransferWarehouseDetail;
use App\Models\ImportProduct;
use App\Models\TransferWarehouse;

class AddProductModal extends ModalComponent
{
    public $products;
    public $product_details;
    public $product_sizes;
    public $warehouses;
    public $product_id;
    public $product_detail_id;
    public $product_size_id;
    public $product_quantity = 0;
    public $product_unit_price = 0;
    public $product_total_amount = 0;
    public $note = '';
    public $warehouse_id;
    public $order_product;
    public $classRef;

    public function mount($mode)
    {
        if($mode == 'New'){
            $this->classRef = AddOrder::class;
        }else{
            $this->classRef = EditOrder::class;
        }
        $this->order_product = new OrderDetail();
        $this->products = Product::all();
        $this->product_details = collect(new ProductDetail);
        $this->product_sizes = collect(new ProductSize);
        $this->warehouses = Warehouse::all();
    }

    public function loadProductAttributes()
    {
        $this->product_details = ProductDetail::where('product_id', $this->product_id)->get();
        $this->product_sizes = ProductSize::where('product_id', $this->product_id)->get();
        $this->product_unit_price = Product::where('id', $this->product_id)->first()->retail_price;
        $this->product_detail_id = '';
        $this->product_size_id = '';
    }
    
    public function updateAmount()
    {
        $this->product_total_amount = $this->product_quantity * $this->product_unit_price;
    }

    public function storeOrderProduct(){
        $this->validate(
            [
                'product_id' => 'required',
                'product_detail_id' => 'required',
                'product_size_id' => 'required',
                'warehouse_id' => 'required',
                'product_quantity' => 'required|numeric|min:1',
                'product_unit_price' => 'required|numeric|min:0',
                'product_total_amount' => 'required|numeric|min:0',
            ],
            [
                'product_id.required' => 'Trường sản phẩm là bắt buộc.',
                'product_detail_id.required' => 'Trường chi tiết sản phẩm là bắt buộc.',
                'product_size_id.required' => 'Trường kích thước là bắt buộc.',
                'warehouse_id.required' => 'Trường kho hàng là bắt buộc.',
                'product_quantity.required' => 'Trường số lượng là bắt buộc.',
                'product_quantity.numeric' => 'Trường số lượng phải là số.',
                'product_quantity.min' => 'Trường số lượng phải lớn hơn 0.',
                'product_unit_price.required' => 'Trường giá bán là bắt buộc.',
                'product_unit_price.numeric' => 'Trường giá bán phải là số.',
                'product_unit_price.min' => 'Trường giá bán không được nhỏ hơn 0.',
                'product_total_amount.required' => 'Trường thành tiền là bắt buộc.',
                'product_total_amount.numeric' => 'Trường thành tiền phải là số.',
                'product_total_amount.min' => 'Trường thành tiền phải lớn hơn 0.',
            ]
        );
        
        $totalAvailable = Warehouse::find($this->warehouse_id)->totalProductAvailable($this->product_id, $this->product_detail_id, $this->product_size_id);

        if($this->product_quantity > $totalAvailable){
            $this->addError('product_quantity', 'Số lượng sản phẩm trong kho không đủ. Sản phẩm còn lại: '.$totalAvailable.' sản phẩm.');
            return;
        }
        $this->order_product->product_id = $this->product_id;
        $this->order_product->product_detail_id = $this->product_detail_id;
        $this->order_product->product_name = $this->order_product->product->name;
        $this->order_product->product_detail_name = $this->order_product->product_detail->title;
        $this->order_product->size_id = $this->product_size_id;
        $this->order_product->size_name = $this->order_product->product_size->size;
        $this->order_product->warehouse_id = $this->warehouse_id;
        $this->order_product->warehouse_name = $this->order_product->warehouse->name;
        $this->order_product->quantity = $this->product_quantity;
        $this->order_product->unit_price = $this->product_unit_price;
        $this->order_product->total_amount = $this->product_total_amount;
        $this->order_product->note = $this->note;
        $this->closeModalWithEvents([
            $this->classRef => ['updateOrderProduct', [$this->order_product, null]],
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }
    public function render()
    {
        return view('livewire.admin.order.add-product-modal');
    }
}
