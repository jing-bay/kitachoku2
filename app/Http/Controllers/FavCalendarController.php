<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FavCalendar;

class FavCalendarController extends Controller
{
    public function store(Request $request)
    {
        FavCalendar::create([
            'calendar_id' => $request->calendar_id,
            'user_id' => Auth::id(),
        ]);
        
        return back();
    }

    public function destroy($fav_calendar_id)
    {
        FavCalendar::find($fav_calendar_id)->delete();
        
        return back();
    }
}
