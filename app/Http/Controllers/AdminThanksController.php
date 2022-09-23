<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminThanksController extends Controller
{
    public function showSend() {
        return view('send_thanks_admin');
    }

        public function showThanks() {
        return view('register_thanks_admin');
    }
}
