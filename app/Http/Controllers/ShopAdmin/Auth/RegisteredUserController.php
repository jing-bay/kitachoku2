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
use App\Http\Requests\RegisterRequest;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('shopadmin.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = ShopAdmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/shop-admin/send-thanks');
    }

    public function showSend()
    {
        return view('send_thanks_shopadmin');
    }

    public function showThanks()
    {
        return view('register_thanks_shopadmin');
    }
}
