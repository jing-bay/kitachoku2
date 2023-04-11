<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Calendar extends Model
{
    protected $fillable = ['user_id', 'shop_id', 'name', 'start_date', 'end_date', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function fav_calendars()
    {
        return $this->hasMany(FavCalendar::class);
    }

    public function is_liked_calendar_by_auth_user()
    {
        $id = Auth::id();
        $fav_users = array();
        
        foreach($this->fav_calendars as $fav_calendar) {
            array_push($fav_users, $fav_calendar->user_id);
        }

        if (in_array($id, $fav_users)) {
            return true;
        } else {
            return false;
        }
    }
}
