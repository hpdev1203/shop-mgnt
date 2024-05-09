<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'Cart_Item';
    protected $fillable = ['id', 'cart_id', 'product_id', 'product_detail_id', 'warehouse_id','quantity','size_id','uom','unit_price_at_time','total_amount'];
    public function product_detail()
    {
        return $this->HasOne(ProductDetail::class, 'id', 'product_detail_id');
    }
    public function product()
    {
        return $this->HasOne(Product::class, 'id', 'product_id');
    }

    public function product_size()
    {
        return $this->belongsTo(ProductSize::class, 'size_id', 'id');
    }
}
