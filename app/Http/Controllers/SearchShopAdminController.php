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
        $search_shop2 = $request->search_shop2;
        $search_email = $request->search_email;

        if(!empty($search_name)){
            $query->where('name', 'LIKE BINARY', '%'.$search_name.'%');
        }

        if(!empty($search_shop2)){
            $search_shops2 = Shop::where('name', 'LIKE BINARY', '%'.$search_shop2.'%')->get();
            $shop_admin_id_array = $search_shops2->pluck('shop_admin_id');

            $query->whereIn('id', $shop_admin_id_array);
        }

        if(!empty($search_email)){
            $query->where('email', 'LIKE BINARY', '%'.$search_email.'%');
        }

        $users = User::all();
        $admin = Auth::guard('admin')->user();
        $shops = Shop::all();
        $shop_admins = $query->get();
        $notices = Notice::all();
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'shop_admins', 'users', 'notices', 'areas', 'search_name', 'search_shop2', 'search_email'));
    }
}
