<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Calendar;
use App\Models\Favorite;
use App\Models\FavCalendar;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        $favorites = Favorite::where('user_id', $id)->get();
        $areas = Area::all();
        $seasons = ['上旬', '中旬', '下旬'];
        $fav_calendars = FavCalendar::where('user_id',$id)->get();
        $calendars = Calendar::where('user_id', $id)->get();

        return view('mypage', compact('user', 'favorites', 'fav_calendars', 'areas', 'seasons', 'calendars'));
    }
}
