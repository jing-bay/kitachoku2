<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Favorite;
use App\Models\Area;
use App\Models\Notice;
use App\Models\Shop;
use App\Models\Coupon;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $areas = Area::all();
        $notices = Notice::latest()->take(3)->get();

        return view('index', compact('tags', 'areas', 'notices'));
    }

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
            $query->where('name', 'like binary', '%'.$search_keyword.'%')
                ->orWhere('address','like binary', '%'.$search_keyword.'%');
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

        return view('search', compact('shops', 'tags', 'areas', 'search_tag', 'search_area', 'search_keyword', 'search_t', 's_a', 'favorites'));
    }

    public function show($shop_id)
    {
        $shop = Shop::find($shop_id);
        $coupons = Coupon::where('shop_id', $shop_id)->get();
        $evaluations = Evaluation::where('shop_id', $shop_id)->get();
        $id = Auth::id();
        $favorites = Favorite::where('user_id', $id)->get();

        return view('detail', compact('shop', 'coupons', 'evaluations', 'favorites'));
    }
}
