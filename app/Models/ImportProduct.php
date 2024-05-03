<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ImportProduct extends Model
{
    use HasFactory;
    protected $table = 'import_product';
    protected $fillable = ['id', 'code', 'name', 'warehouse_id'];

    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function importDetails()
    {
        return $this->hasMany(ImportProductDetail::class, 'import_product_id', 'id');
    }
}
