<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ProductDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $table = 'product_detail';
    protected $fillable = ['product_id', 'image', 'color', 'short_description'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
