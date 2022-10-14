<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Coupon;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsShopAdminController extends Controller
{
    public function index()
    {
        $shop_admin = Auth::guard('shopadmin')->user();
        $id = Auth::guard('shopadmin')->id();
        $shop = Shop::where('shop_admin_id', $id)->first();
        if(!empty($shop)){
            $coupons = Coupon::where('shop_id', $shop->id)->get();
            $reservation_ids = $coupons->pluck('id')->toArray();
            $reservations = Reservation::whereIn('coupon_id', $reservation_ids)->get();
            $tagIds = $shop->tags()->pluck('tags.id')->toArray();
        } else {
            $coupons = '';
            $reservations  = '';
            $tagIds = '';
        }
        $areas = Area::all();
        $tags = Tag::all();

        return view('settings_shopadmin', compact('shop_admin', 'shop', 'reservations', 'coupons', 'areas', 'tags','tagIds'));
    }
}
