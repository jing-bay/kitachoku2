<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\ShopAdmin;
use App\Models\User;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchUserController extends Controller
{
    public function search(Request $request)
    {
        $query = User::query();

        $search_name2 = $request->search_name2;
        $search_nickname = $request->search_nickname;
        $search_email2 = $request->search_email2;

        if(!empty($search_name2)){
            $query->where('name', 'LIKE BINARY', '%'.$search_name2.'%');
        }

        if(!empty($search_nickname)){
            $query->where('nickname', 'LIKE BINARY', '%'.$search_nickname.'%');
        }

        if(!empty($search_email2)){
            $query->where('email', 'LIKE BINARY', '%'.$search_email2.'%');
        }

        $users = $query->get();
        $admin = Auth::guard('admin')->user();
        $shops = Shop::all();
        $shop_admins = ShopAdmin::all();
        $notices = Notice::all();
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'shop_admins', 'users', 'notices', 'areas', 'search_name2', 'search_nickname', 'search_email2'));
    }
}
