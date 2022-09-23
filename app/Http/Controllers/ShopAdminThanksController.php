<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopAdminThanksController extends Controller
{
    public function showSend() {
        return view('send_thanks_shopadmin');
    }

        public function showThanks() {
        return view('register_thanks_shopadmin');
    }
}
