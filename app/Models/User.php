<?php

namespace App\Models;

use App\Models\Api\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $guarded = [
    ];

    protected $hidden = [
      'password',
      'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
