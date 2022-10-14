<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'reservation_date', 'reservation_time', 'coupon_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }

        public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
