<?php

namespace App\Http\Controllers;

use\App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function update(RegisterRequest $request)
    {
        $id = Auth::id();
        $form = $request->all();
        User::find($id)->update($form);

        return back();
    }

    public function destroy()
    {
        $id = Auth::id();
        User::find($id)->delete();
        return redirect('/user/destroy/withdraw');
    }

    public function show()
    {
        return view('user_withdraw');
    }
    
}
