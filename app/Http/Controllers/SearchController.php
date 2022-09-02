<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Area;
use App\Models\Notice;
use App\Models\Shop;
use App\Models\Coupon;
use App\Models\Evaluation;

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

        if(is_array($search_tag)){
            $query->whereHas('tags', function($q) use($search_tag){
                $q->whereIn('tags.id', $search_tag);
            });
        };

        if(!empty($search_area)){
            $query->where('area_id', $search_area);
        };

        if(!empty($search_keyword)){
            $query->where('name', 'like', '%'.$search_keyword.'%')
                ->orWhere('address','like', '%'.$search_keyword.'%');
        }

        $shops = $query->get();

        $tags = Tag::all();
        $areas = Area::all();

        return view('search', compact('shops', 'tags', 'areas'));
    }

    public function show($shop_id)
    {
        $shop = Shop::find($shop_id)->first();
        $coupons = Coupon::where('shop_id', $shop_id)->get();
        $evaluations = Evaluation::where('shop_id', $shop_id)->get();

        return view('detail', compact('shop', 'coupons', 'evaluations'));

    }
}
