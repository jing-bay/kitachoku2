<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Evaluation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SearchFavoriteController extends Controller
{
    public function search(Request $request)
    {
        $id = Auth::id();
        $query = Favorite::where('user_id', $id);

        $search_name = $request->search_name;
        $search_area = $request->search_area;

        if(!empty($search_name)){
            $search_name_id = Shop::where('name', 'LIKE BINARY', '%'.$search_name.'%')->pluck('id')->toArray();
            $query->whereIn('shop_id', $search_name_id);
        }

        if(!empty($search_area)){
            $search_area_id = Shop::where('area_id', $search_area)->pluck('id')->toArray();
            $query->whereIn('shop_id', $search_area_id);
        }

        $favorites = $query->get();

        $user = Auth::user();
        $id = Auth::id();
        $today = date("Y-m-d");
        $unvisited_reservations = Reservation::where('user_id', $id)->where('reservation_date', '>=', $today)->orderBy('id', 'asc')->get();
        $visited_reservations = Reservation::where('user_id', $id)->where('reservation_date', '<', $today)->orderBy('id', 'asc')->get();
        $reservation_ids = Reservation::where('user_id', $id)->pluck('id')->toArray();
        $evaluations = Evaluation::whereIn('reservation_id', $reservation_ids)->get();
        $areas = Area::all();

        return view('mypage', compact('user', 'unvisited_reservations', 'favorites', 'visited_reservations', 'evaluations', 'areas', 'search_name', 'search_area'));
    }
}
