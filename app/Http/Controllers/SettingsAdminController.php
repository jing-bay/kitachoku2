<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\ShopAdmin;
use App\Models\User;
use App\Models\Tag;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsAdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $shops = Shop::all();
        $shop_admins = ShopAdmin::all();
        $users = User::all();
        $notices = Notice::all();
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'shop_admins', 'users', 'notices', 'areas'));
    }

    public function editShop($shop_id)
    {
        $shop = Shop::find($shop_id);
        $tagIds = $shop->tags()->pluck('tags.id')->toArray();
        $areas = Area::all();
        $tags = Tag::all();

        return view('edit_shop', compact('shop', 'areas', 'tags', 'tagIds'));
    }

    public function editShopAdmin($shop_admin_id)
    {
        $shop_admin = ShopAdmin::find($shop_admin_id);

        return view('edit_shop_admin', compact('shop_admin'));
    }

    public function editUser($user_id)
    {
        $user = User::find($user_id);

        return view('edit_user', compact('user'));
    }
}
