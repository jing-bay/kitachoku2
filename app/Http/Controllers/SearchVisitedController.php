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
        $query = Reservation::where('user_id', $id)->where('reservation_date', '<', $today)->orderBy('id', 'asc');

        $search_name = $request->search_name;
        $search_area = $request->search_area;
        $search_from_date = $request->search_from_date;
        $search_to_date = $request->search_to_date;

        if(!empty($search_name)){
            $search_name_id = Shop::where('name', $search_name)->pluck('id')->toArray();
            $search_name_coupon_id = Coupon::whereIn('shop_id', $search_name_id)->pluck('id')->toArray();
            $query->whereIn('coupon_id', $search_name_coupon_id);
        }

        if(!empty($search_area)){
            $search_area_id = Shop::where('area_id', $search_area)->pluck('id')->toArray();
            $search_area_coupon_id = Coupon::whereIn('shop_id', $search_area_id)->pluck('id')->toArray();
            $query->whereIn('coupon_id', $search_name_coupon_id);
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
        $today = date("Y-m-d");
        $unvisited_reservations = Reservation::where('user_id', $id)->where('reservation_date', '>=', $today)->orderBy('id', 'asc')->get();
        $favorites = Favorite::where('user_id', $id)->get();
        $evaluations = Evalution::where('user_id', $id)->get();
        $areas = Area::all();

        return view('mypage', compact('user', 'unvisited_reservations', 'favorites', 'visited_reservations', 'evaluations', 'areas'));
    }
}
