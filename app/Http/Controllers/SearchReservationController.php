<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Tag;
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
        $shop_admin = Auth::guard('shopadmin')->user();
        $id = Auth::guard('shopadmin')->id();
        $shop = Shop::where('shop_admin_id', $id)->first();
        $coupons = Coupon::where('shop_id', $shop->id)->get();
        $tagIds = $shop->tags()->pluck('tags.id')->toArray();
        $areas = Area::all();
        $tags = Tag::all();
        $reservation_ids = $coupons->pluck('id')->toArray();
        $query = Reservation::whereIn('coupon_id', $reservation_ids);

        $search_coupon = $request->search_coupon;
        $search_name = $request->search_name;
        $search_from_date = $request->search_from_date;
        $search_to_date = $request->search_to_date;

        if(!empty($search_coupon)){
            $query->where('coupon_id', $search_coupon);
        }

        if(!empty($search_name)){
            $search_name_id = User::where('name', 'LIKE BINARY', '%'.$search_name.'%')->pluck('id')->toArray();
            $query->whereIn('user_id', $search_name_id);
        }

        if(!empty($search_from_date)){
            $query->where('reservation_date', '>=',$search_from_date);
        }

        if(!empty($search_to_date)){
            $query->where('reservation_date', '<=',$search_to_date);
        }

        $reservations = $query->get();

        return view('settings_shopadmin', compact('shop_admin', 'shop', 'reservations', 'coupons', 'areas', 'tags','tagIds', 'search_coupon', 'search_name', 'search_from_date', 'search_to_date'));
    }
}