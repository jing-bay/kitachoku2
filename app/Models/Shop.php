<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'shop_admin_id', 'area_id', 'postal_code', 'address', 'opening_hour', 'holiday', 'tel_number', 'email', 'overview', 'shop_img', 'shop_url', 'twitter_url', 'facebook_url'];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function shopAdmin()
    {
        return $this->belongsTo(ShopAdmin::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function tags()
    { 
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
