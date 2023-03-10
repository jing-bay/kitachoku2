<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Favorite;
use App\Models\Shop;
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
        $areas = Area::all();

        return view('mypage', compact('user', 'favorites', 'areas', 'search_name', 'search_area'));
    }
}
