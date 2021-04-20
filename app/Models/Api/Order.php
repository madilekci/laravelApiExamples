<?php

namespace App\Models\Api;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $hidden = ['id','user_id','updated_at','created_at'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function isUpdatable()
    {
        $shippingDate = Carbon::parse($this->attributes['shippingDate']);

        if ($shippingDate->isPast()) {
            return false;
        } else {
            return true;
        }
    }

    public function setShippingDateAttribute($value)
    {
        $this->attributes['shippingDate']=Carbon::parse($value)->format('Y-m-d');
    }
}
