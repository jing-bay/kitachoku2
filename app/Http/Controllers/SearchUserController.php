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

        $search_name = $request->search_name;
        $search_nickname = $request->search_nickname;
        $search_email = $request->search_email;

        if(!empty($search_name)){
            $query->where('name', $search_name);
        }

        if(!empty($search_nickname)){
            $query->where('nickname', $search_nickname);
        }

        if(!empty($search_email)){
            $query->where('email', $search_email);
        }

        $users = $query->paginate(100);
        $admin = Auth::guard('admin')->user();
        $shops = Shop::paginate(100);
        $shop_admins = ShopAdmin::paginate(100);
        $notices = Notice::paginate(100);
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'shop_admins', 'users', 'notices', 'areas'));
    }
}
