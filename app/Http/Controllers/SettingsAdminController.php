<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\ShopAdmin;
use App\Models\User;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class SettingsAdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $shops = Shop::paginate(100);
        $shop_admins = ShopAdmin::paginate(100);
        $users = User::paginate(100);
        $notices = Notice::paginate(100);
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'shop_admins', 'users', 'notices', 'areas'));
    }
}
