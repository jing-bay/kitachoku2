<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\ShopAdmin;
use App\Models\User;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchShopAdminController extends Controller
{
    public function search(Request $request)
    {
        $query = ShopAdmin::query();

        $search_name = $request->search_name;
        $search_shop = $request->search_shop;
        $search_email = $request->search_email;

        if(!empty($search_name)){
            $query->where('name', $search_name);
        }

        if(!empty($search_shop)){
            $search_shops = Shop::where('name', $search_shop)->get();
            $shop_admin_id_array = $search_shops->pluck('shop_admin_id');

            $query->find($shop_admin_id_array);
        }

        if(!empty($search_email)){
            $query->where('email', $search_email);
        }

        $users = User::paginate(100);
        $admin = Auth::guard('admin')->user();
        $shops = Shop::paginate(100);
        $shop_admins = $query->paginate(100);
        $notices = Notice::paginate(100);
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'shop_admins', 'users', 'notices', 'areas'));
    }
}
