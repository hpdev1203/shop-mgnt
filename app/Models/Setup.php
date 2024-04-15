<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    use HasFactory;
    protected $table = 'setup';
    protected $fillable = [
        'step_1',
        'step_2',
        'step_3',
        'step_4',
        'is_completed',
    ];
}
