<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\ShopAdmin;
use App\Models\User;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SearchShopController extends Controller
{
    public function search(Request $request)
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
        $shop_admins = ShopAdmin::all();
        $users = User::all();
        $notices = Notice::all();
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'shop_admins', 'users', 'notices', 'areas','search_shop', 'search_area'));
    }
}
