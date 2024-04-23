<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportProduct extends Model
{
    use HasFactory;
    protected $table = 'import_product';
    protected $fillable = ['id', 'code', 'name', 'warehouse_id'];
}
