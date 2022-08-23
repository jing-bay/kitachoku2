<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'reservation_date', 'reservation_time', 'coupon_id'];

    public function coupon()
    {
        return $this->belongTo(Coupon::class);
    }

    public function user()
    {
        return $this->belongTo(User::class);
    }
}
