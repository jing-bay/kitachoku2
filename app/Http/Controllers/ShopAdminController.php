<?php

namespace App\Http\Controllers;

use App\Models\ShopAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShopAdminRegisterRequest;

class ShopAdminController extends Controller
{
    public function update(ShopAdminRegisterRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        $id = Auth::guard('shopadmin')->id();
        ShopAdmin::find($id)->update($form);

        return back();
    }

    public function destory()
    {
        $id = Auth::guard('shopadmin')->id();
        ShopAdmin::find($id)->delete();

        return redirect('/shopadmin/destroy/withdraw');
    }

    public function show()
    {
        return view('shopadmin_withdraw');
    }
}
