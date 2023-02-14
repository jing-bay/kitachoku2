<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\User;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsAdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $shops = Shop::all();
        $users = User::all();
        $notices = Notice::all();
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'users', 'notices', 'areas'));
    }

    public function editUser($user_id)
    {
        $user = User::find($user_id);

        return view('edit_user', compact('user'));
    }
}
