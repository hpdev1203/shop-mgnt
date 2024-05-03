<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransferWarehouse extends Model
{
    use HasFactory;
    protected $table = 'transfer_product';
    protected $fillable = ['id', 'code', 'name', 'from_warehouse_id', 'to_warehouse_id'];

    public function from_warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'id', 'from_warehouse_id');
    }
    public function to_warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class, 'id', 'to_warehouse_id');
    }

    public function transferDetails()
    {
        return $this->hasMany(TransferWarehouseDetail::class, 'transfer_product_id', 'id');
    }
}
