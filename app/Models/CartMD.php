<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartMD extends Model
{
    use HasFactory;
    protected $table = 'cart';
    //protected $fillable = ['id', 'user_id'];
    public function cart_item()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }
}
