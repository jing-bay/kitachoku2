<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchReservationController extends Controller
{
    public function search(Request $request)
    {
        $query = Reservation::query();

        $search_coupon = $request->search_coupon;
        $search_name = $request->search_name;
        $search_from_date = $request->search_from_date;
        $search_to_date = $request->search_to_date;

        if(!empty($search_coupon)){
            $query->where('coupon_id', $search_coupon);
        }

        if(!empty($search_name)){
            $search_name_id = User::where('name', $search_name)->pluck('id')->toArray();
            $query->whereIn('user_id', $search_name_id);
        }

        if(!empty($search_from_date)){
            $query->where('reservation_date', '>=',$search_from_date);
        }

        if(!empty($search_to_date)){
            $query->where('reservation_date', '<=',$search_from_date);
        }

        $reservations = $query->get();

        $shop_admin = Auth::guard('shopadmin')->user();
        $id = Auth::guard('shopadmin')->id();
        $shop = Shop::where('user_id', $id)->first();
        $coupons = Coupon::where('shop_id', $shop->shop_id)->get();
        $areas = Area::all();

        return view('settings_shop', compact('shop_admin', 'shop', 'reservations', 'coupons', 'areas'));
    }
}