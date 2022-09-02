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
    public function search(Request $requset)
    {
        $query = Shop::query();

        $search_name = $request->search_name;
        $search_area = $request->search_area;

        if(!empty($search_name)){
            $query->where('name', $search_name);
        }

        if(!empty($search_area)){
            $query->where('area_id', $search_area);
        }

        $shops = $query->paginate(100);
        $admin = Auth::guard('admin')->user();
        $shop_admins = ShopAdmin::paginate(100);
        $users = User::paginate(100);
        $notices = Notice::paginate(100);
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'shop_admins', 'users', 'notices', 'areas'));
    }
}
