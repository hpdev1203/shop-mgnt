<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'username',
        'gender',
        'phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function hasOrder()
    {
        return $this->hasMany(Order::class, 'user_id', 'id')->count() > 0;
    }
    public function hasContact()
    {
        return $this->hasMany(ContactUser::class, 'user_id', 'id')->count() > 0;
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id')->where('status','<>','rejected');
    }
    public function ordersPaid()
    {
        return $this->hasMany(Order::class, 'user_id', 'id')->where('status','<>','rejected')->where('payment_status','=','paid');
    }
}
