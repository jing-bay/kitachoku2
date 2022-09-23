<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Evaluation;
use App\Models\Shop;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchVisitedController extends Controller
{
    public function search(Request $request)
    {
        $id = Auth::id();
        $today = date("Y-m-d");
        $query = Reservation::where('user_id', $id)->where('reservation_date', '<=', $today)->orderBy('id', 'asc');

        $search_name2 = $request->search_name2;
        $search_area2 = $request->search_area2;
        $search_from_date = $request->search_from_date;
        $search_to_date = $request->search_to_date;

        if(!empty($search_name2)){
            $search_name_id = Shop::where('name', 'likebinary', '%'.$search_name2.'%')->pluck('id')->toArray();
            $search_name_coupon_id = Coupon::whereIn('shop_id', $search_name_id)->pluck('id')->toArray();
            $query->whereIn('coupon_id', $search_name_coupon_id);
        }

        if(!empty($search_area2)){
            $search_area_id = Shop::where('area_id', $search_area2)->pluck('id')->toArray();
            $search_area_coupon_id = Coupon::whereIn('shop_id', $search_area_id)->pluck('id')->toArray();
            $query->whereIn('coupon_id', $search_area_coupon_id);
        }

        if(!empty($search_from_date)){
            $query->where('reservation_date', '>=',$search_from_date);
        }

        if(!empty($search_to_date)){
            $query->where('reservation_date', '<=',$search_from_date);
        }

        $visited_reservations = $query->get();

        $user = Auth::user();
        $id = Auth::id();
        $unvisited_reservations = Reservation::where('user_id', $id)->where('reservation_date', '>', $today)->orderBy('id', 'asc')->get();
        $favorites = Favorite::where('user_id', $id)->get();
        $reservation_ids = Reservation::where('user_id', $id)->pluck('id')->toArray();
        $evaluations = Evaluation::whereIn('reservation_id', $reservation_ids)->get();
        $areas = Area::all();

        return view('mypage', compact('user', 'unvisited_reservations', 'favorites', 'visited_reservations', 'evaluations', 'areas', 'search_name2', 'search_area2', 'search_from_date', 'search_to_date'));
    }
}
