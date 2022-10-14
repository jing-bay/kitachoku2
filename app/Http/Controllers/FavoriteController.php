<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        Favorite::create([
            'shop_id' => $request->shop_id,
            'user_id' => Auth::id(),
        ]);
        
        return back();
    }

    public function destroy($favorite_id)
    {
        Favorite::find($favorite_id)->delete();
        
        return back();
    }
}
