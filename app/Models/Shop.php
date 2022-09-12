<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function is_liked_by_auth_user()
    {
        $id = Auth::id();
        $fav_users = array();
        
        foreach($this->favorites as $favorite) {
            array_push($fav_users, $favorite->user_id);
        }

        if (in_array($id, $fav_users)) {
            return true;
        } else {
            return false;
        }
    }
}
