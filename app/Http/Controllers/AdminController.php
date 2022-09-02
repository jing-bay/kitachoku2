<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Shop;
use App\Models\ShopAdmin;
use App\Models\User;
use App\Models\Notice;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRegisterRequest;

class AdminController extends Controller
{
    public function update(AdminRegisterRequest $request)
    {
        $form = $request->all();
        $id = Auth::guard('admin')->id();
        Admin::find($id)->update($form);

        return back();
    }

    public function destory()
    {
        $id = Auth::guard('admin')->id();
        Admin::find($id)->delete();

        return redirect('/admin/destroy/withdraw');
    }

    public function show()
    {
        return view('admin_withdraw');
    }
}
