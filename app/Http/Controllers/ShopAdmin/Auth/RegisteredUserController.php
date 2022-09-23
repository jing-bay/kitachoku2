<?php

namespace App\Http\Controllers\ShopAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Models\ShopAdmin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Requests\ShopAdminRegisterRequest;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('shopadmin.auth.register');
    }

    public function store(ShopAdminRegisterRequest $request)
    {
        $user = ShopAdmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('shopadmin')->login($user);

        return redirect('/shop-admin/send-thanks');
    }
}
