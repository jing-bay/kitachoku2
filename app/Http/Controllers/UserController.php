<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Notice;
use App\Models\Area;
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

    public function search(Request $request)
    {
        $query = User::query();

        $search_name2 = $request->search_name2;
        $search_nickname = $request->search_nickname;
        $search_email2 = $request->search_email2;

        if(!empty($search_name2)){
            $query->where('name', 'LIKE BINARY', '%'.$search_name2.'%');
        }

        if(!empty($search_nickname)){
            $query->where('nickname', 'LIKE BINARY', '%'.$search_nickname.'%');
        }

        if(!empty($search_email2)){
            $query->where('email', 'LIKE BINARY', '%'.$search_email2.'%');
        }

        $users = $query->get();
        $admin = Auth::guard('admin')->user();
        $shops = Shop::all();
        $notices = Notice::all();
        $areas = Area::all();

        return view('settings_admin', compact('admin', 'shops', 'users', 'notices', 'areas', 'search_name2', 'search_nickname', 'search_email2'));
    }

    public function show()
    {
        return view('user_withdraw');
    }

    public function showSend()
    {
        return view('send_thanks');
    }

    public function showThanks()
    {
        return view('register_thanks');
    }
}
