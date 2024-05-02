<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    public function customer(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }
}
