<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    public function update(AdminRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        $id = Auth::guard('admin')->id();
        Admin::find($id)->update($form);

        return back();
    }

    public function destroy()
    {
        $id = Auth::guard('admin')->id();
        Admin::find($id)->delete();

        return redirect('/admin/destroy/withdraw');
    }

    public function show()
    {
        return view('admin_withdraw');
    }

    public function showSend() 
    {
        return view('send_thanks_admin');
    }

    public function showThanks() 
    {
        return view('register_thanks_admin');
    }
}
