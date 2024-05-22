<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductSize extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $table = 'product_size';

    public function productAvailable($product_id, $product_detail_id, $product_size_id, $warehouse_id)
    {
    $product_detail = ProductDetail::find($product_detail_id);
        $warehouse = Warehouse::find($warehouse_id);
        $product_warehouse = $product_detail->product->warehouses()->where('warehouse_id', $warehouse_id)->first();
        if($product_warehouse){
            return $product_warehouse->pivot->quantity;
        }else{
            return 0;
        }
    }
}
