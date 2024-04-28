<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;
    protected $table = 'payment_status';
    protected $fillable = ['id', 'code', 'name', 'description', 'color', 'icon', 'sort_order', 'is_default', 'is_active'];
}
