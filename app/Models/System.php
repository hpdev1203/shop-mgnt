<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;
    protected $table = 'system_information';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
        'logo',
    ];
}
