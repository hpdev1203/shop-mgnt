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
        $product_warehouse = Warehouse::find($warehouse_id);
        if($product_warehouse){
            return $product_warehouse->totalProductAvailable($product_id, $product_detail_id, $product_size_id);
        }else{
            return 0;
        }
    }
}
