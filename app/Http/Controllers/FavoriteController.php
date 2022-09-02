<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $form = $request->all();
        Favorite::create($form);
        return back();
    }

    public function destroy($favorite_id)
    {
        Favorite::find($favorite_id)->delete();
        return back();
    }
}
