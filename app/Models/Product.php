<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $fillable = ['id'];
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
    public function importProducts()
    {
        return $this->hasMany(ImportProductDetail::class, 'product_id', 'id');
    }
    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class)
            ->leftJoin('order_status', 'order_detail.order_id', '=', 'order_status.order_id')
            ->where(function($query) {
                $query->where('order_status.status', '!=', 'rejected')
                      ->orWhereNull('order_status.status');
            })
            ->select('*');
    }
    public function productBrand()
    {
        return $this->HasOne(Brand::class, 'id', 'brand_id');
    }
    public function productCategory()
    {
        return $this->HasOne(Category::class, 'id', 'category_id');
    }
    public function totalImported()
    {
        return $this->importProducts()->sum('quantity');
    }
    public function totalSold()
    {
        return $this->orderDetails()->sum('quantity');
    }
    public function totalAvailable()
    {
        return $this->totalImported() - $this->totalSold();
    }
    public function warehouses(){
        $listImportId = $this->importProducts()->pluck('import_product_id')->toArray();
        $listWarehouseId = ImportProduct::whereIn('id', $listImportId)->pluck('warehouse_id')->toArray();
        $listWarehouseId = array_unique($listWarehouseId);
        return Warehouse::whereIn('id', $listWarehouseId)->get();
    }
    public function hasOrder(){
        return $this->orderDetails()->count() > 0;
    }
    public function hasImport(){
        return $this->importProducts()->count() > 0;
    }
}
