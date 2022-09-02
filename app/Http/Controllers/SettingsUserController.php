<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('settings_user', compact('user'));
    }
}
