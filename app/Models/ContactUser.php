<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUser extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = ['id', 'user_id', 'subject', 'description'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
