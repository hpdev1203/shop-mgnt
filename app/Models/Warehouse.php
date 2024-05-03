<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Warehouse extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $table = 'Warehouse';
    protected $fillable = ['code', 'name', 'address', 'phone', 'logo'];

    public function importProducts()
    {
        return $this->hasMany(ImportProduct::class, 'warehouse_id', 'id');
    }

    public function transferWarehouseFrom()
    {
        return $this->hasMany(TransferWarehouse::class, 'from_warehouse_id', 'id');
    }

    public function transferWarehouseTo()
    {
        return $this->hasMany(TransferWarehouse::class, 'to_warehouse_id', 'id');
    }
}
