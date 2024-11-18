<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'user_id',
        'payment_method_id',
        'payment_status',
        'order_date',
        'status',
        'note',
        'shipping_phone',
        'shipping_email',
        'shipping_address',
        'shipping_state',
        'shipping_city',
        'subtotal_amount',
        'discount_amount',
        'grandtotal_amount',
        'shipping_amount',
        'total_amount',
        'discount_percent',
    ];
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
    public function orderStatus()
    {
        return $this->hasMany(OrderStatus::class, 'order_id', 'id');
    }
}
