<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Calendar;
use App\Models\FavCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchCalendarController extends Controller
{
    public function search(Request $request)
    {
        $query = Calendar::query();

        $search_shop = $request->search_shop;
        $search_item = $request->search_item;
        $search_date = $request->search_date;

        if(!empty($search_shop)) {
            $query->whereIn('shop_id', Shop::query()
                    ->where('name', 'LIKE BINARY', '%'.$search_shop.'%')
                    ->pluck('id')
                );
        }

        if(!empty($search_item)) {
            $query->where('name', 'LIKE BINARY', '%'.$search_item.'%');
        }

        if(!empty($search_date)) {
            $query->where('start_date', '<=', $search_date)
                ->where('end_date', '>=', $search_date);
        }

        $id = Auth::id();
        $fav_calendars = FavCalendar::where('user_id',$id)->get();

        $calendars = $query->paginate(20)->withQueryString();

        return view('search_calendar', compact('calendars', 'fav_calendars','search_shop', 'search_item', 'search_date'));
    }

    public function show($user_id)
    {
        $calendars = Calendar::where('user_id', $user_id)->get();
        $fav_calendars = FavCalendar::where('user_id',$user_id)->get();
        $user = User::find($user_id);
        $seasons = ['上旬', '中旬', '下旬'];

        return view('calendar', compact('calendars', 'fav_calendars', 'user', 'seasons'));
    }
}
