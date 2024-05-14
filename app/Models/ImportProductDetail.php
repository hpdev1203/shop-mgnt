<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportProductDetail extends Model
{
    use HasFactory;
    protected $table = 'import_product_detail';
    protected $fillable = ['product_id', 'product_detail_id', 'quantity', 'size_id'];

    public function importProduct()
    {
        return $this->belongsTo(ImportProduct::class, 'import_product_id', 'id');
    }

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
