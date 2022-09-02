<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Tag;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;

class ShopController extends Controller
{
    public function create()
    {
        $areas = Area::all();
        $tags = Tag::all();

        return view('create_shop', compact('areas', 'tags', 'shop_admin_id'));
    }

    public function store(ShopRequest $request)
    {
        $form = $request->all();
        $shop = Shop::create($form);
        $shop->tags()->attach($form->tags);
        
        return redirect('/shop/done');
    }

    public function edit($shop_id)
    {
        $shop = Shop::find($shop_id);
        $tags = $shop->tags->pluck('id')->toArray();
        $areas = Area::all();
        $tags_list = Tag::all();

        return view('edit_shop', compact('shop', 'areas', 'tags', 'tags_list'));
    }

    public function update($shop_id, ShopRequest $request)
    {
        $form = $request->all();
        Shop::find($shop_id)->update($form);
        $shop = Shop::find($shop_id);
        $shop->tags()->sync($request->tags);

        return redirect('/shop/done');
    }

    public function show()
    {
        return view('shop_done');
    }

    public function destroy($shop_id)
    {
        Shop::find($shop_id)->delete();

        return redirect('/shop/done');
    }
}