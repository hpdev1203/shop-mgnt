<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferWarehouseDetail extends Model
{
    use HasFactory;
    protected $table = 'transfer_product_detail';
    protected $fillable = ['product_id', 'product_detail_id', 'quantity', 'size_id'];

    public function product()
    {
        return $this->HasOne(Product::class, 'id', 'product_id');
    }

    public function product_detail()
    {
        return $this->HasOne(ProductDetail::class, 'id', 'product_detail_id');
    }

    public function product_size()
    {
        return $this->HasOne(ProductSize::class, 'id', 'size_id');
    }
}
