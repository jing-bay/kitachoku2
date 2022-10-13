<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        $today = date("Y-m-d");
        $unvisited_reservations = Reservation::where('user_id', $id)->where('reservation_date', '>', $today)->orderBy('id', 'asc')->get();
        $favorites = Favorite::where('user_id', $id)->get();
        $visited_reservations = Reservation::where('user_id', $id)->where('reservation_date', '>=', $today)->orderBy('id', 'asc')->get();
        $reservation_ids = Reservation::where('user_id', $id)->pluck('id')->toArray();
        $evaluations = Evaluation::whereIn('reservation_id', $reservation_ids)->get();
        $areas = Area::all();

        return view('mypage', compact('user', 'unvisited_reservations', 'favorites', 'visited_reservations', 'evaluations', 'areas'));
    }
}
