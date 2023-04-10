<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FavCaendar;

class FavCalendarController extends Controller
{
    public function store(Request $request)
    {
        FavCaendar::create([
            'calendar_id' => $request->calendar_id,
            'user_id' => Auth::id(),
        ]);
        
        return back();
    }

    public function destroy($favCaendar_id)
    {
        FavCaendar::find($favCaendar_id)->delete();
        
        return back();
    }
}
