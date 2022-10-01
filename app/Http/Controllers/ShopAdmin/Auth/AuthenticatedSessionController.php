<?php

namespace App\Http\Controllers\ShopAdmin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopAdmin\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('shopadmin.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('/shopadmin/settings');
    }
    
    public function destroy(Request $request)
    {
        Auth::guard('shopadmin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/shopadmin/login');
    }
}
