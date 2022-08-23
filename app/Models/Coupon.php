<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'name'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
