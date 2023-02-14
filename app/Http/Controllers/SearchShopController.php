<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Favorite;
use App\Models\Calendar;
use App\Models\Area;
use App\Models\User;
use App\Models\Notice;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchShopController extends Controller
{
    public function search(Request $request)
    {
        $query = Shop::query();

        $search_tag = $request->search_tag;
        $search_area = $request->search_area;
        $search_keyword = $request->search_keyword;

        if(is_array($search_tag)) {
            $query->whereHas('tags', function($q) use($search_tag) {
                $q->whereIn('tags.id', $search_tag);
            });
        }

        if(!empty($search_area)) {
            $query->where('area_id', $search_area);
        }

        if(!empty($search_keyword)) {
            $query->where('name', 'LIKE BINARY', '%'.$search_keyword.'%')
                ->orWhere('address','LIKE BINARY', '%'.$search_keyword.'%');
        }

        $shops = $query->paginate(12)->withQueryString();

        $tags = Tag::all();
        $areas = Area::all();
        $id = Auth::id();
        $favorites = Favorite::where('user_id', $id)->get();
    
        if(is_array($search_tag)) {
            $search_t = Tag::whereIn('id', $search_tag)->get();
        } else {
            $search_t = NULL;
        }

        if(!empty($search_area)){
            $s_a = Area::find($search_area);
        } else {
            $s_a = NULL;
        }

        return view('result', compact('shops', 'tags', 'areas', 'search_tag', 'search_area', 'search_keyword', 'search_t', 's_a', 'favorites'));
    }

    public function show($shop_id)
    {
        $shop = Shop::find($shop_id);
        $id = Auth::id();
        $favorites = Favorite::where('user_id', $id)->get();
        $calendars = Calendar::where('shop_id', $shop_id)->get();

        return view('detail', compact('shop', 'favorites', 'calendars'));
    }

    public function searchAdmin(Request $request)
    {
        $query = Shop::query();

        $search_shop = $request->search_shop;
        $search_area = $request->search_area;

        if(!empty($search_shop)){
            $query->where('name', 'LIKE BINARY', '%'.$search_shop.'%');
        }

        if(!empty($search_area)){
            $query->where('area_id', $search_area);
        }

        $shops = $query->get();
        $admin = Auth::guard('admin')->user();
        $users = User::all();
        $notices = Notice::all();
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'users', 'notices', 'areas','search_shop', 'search_area'));
    }
}
