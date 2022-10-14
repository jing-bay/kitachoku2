<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function update(UserRequest $request)
    {
        if(empty($request->id)){
            $id = Auth::id();
        } else {
            $id = $request->id;
        };

        $form = $request->all();
        unset($form['_token']);

        User::find($id)->update($form);

        return back();
    }

    public function destroy(Request $request)
    {
        if(empty($request->user_id)){
            $id = Auth::id();
        } else {
            $id = $request->user_id;
        };

        User::find($id)->delete();
        
        return redirect('/user/destroy/withdraw');
    }

    public function show()
    {
        return view('user_withdraw');
    }
    
}
