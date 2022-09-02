<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsShopAdminController extends Controller
{
    public function index()
    {
        $shop_admin = Auth::guard('shopadmin')->user();
        $id = Auth::guard('shopadmin')->id();
        $shop = Shop::where('user_id', $id)->first();
        $reservations = Reservation::where('user_id', $id)->paginate(100);
        $coupons = Coupon::where('shop_id', $shop->shop_id)->get();
        $areas = Area::all();

        return view('settings_shop', compact('shop_admin', 'shop', 'reservations', 'coupons', 'areas'));
    }
}
