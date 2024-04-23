<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportProductDetail extends Model
{
    use HasFactory;
    protected $table = 'import_product_detail';
    protected $fillable = ['product_id', 'product_detail_id', 'quantity', 'size_id'];
}
