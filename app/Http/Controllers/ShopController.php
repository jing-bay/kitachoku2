<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Tag;
use App\Http\Requests\ShopRequest;
use App\Http\Requests\UpdateShopRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function create()
    {   
        $areas = Area::all();
        $tags = Tag::all();

        return view('create_shop', compact('areas', 'tags'));
    }

    public function store(ShopRequest $request)
    {
        $s = Str::uuid();

        if(isset($request->shop_img)) {
            $file_name = $request->file('shop_img')->getClientOriginalName();
            Storage::putFileAs('public/shopimg', $request->file('shop_img'), $s.'.'.$request->shop_img->extension());
            $file_path = $s.'.'.$request->shop_img->extension();
        } else { 
            $file_name = NULL;
            $file_path = NULL;
        }

        $shop = Shop::create([
            'name' => $request->name2,
            'area_id' => $request->area_id,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'opening_hour' => $request->opening_hour,
            'holiday' => $request->holiday,
            'tel_number' => $request->tel_number,
            'email' => $request->email2,
            'shop_img' => $file_name,
            'shop_img_rename' => $file_path,
            'shop_url' => $request->shop_url,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
        ]);

        $shop->tags()->attach($request->tag_ids);

        return redirect('/shop/done');

    }

    public function edit($shop_id)
    {
        $shop = Shop::find($shop_id);
        $tagIds = $shop->tags()->pluck('tags.id')->toArray();
        $areas = Area::all();
        $tags = Tag::all();

        return view('edit_shop', compact('shop', 'areas', 'tags', 'tagIds'));
    }

    public function update($shop_id, UpdateShopRequest $request)
    {
        $shop = Shop::find($shop_id);
        $old_shop_img = $shop->shop_img;
        $old_shop_img_rename = $shop->shop_img_rename;
        
        if(empty($request->file('shop_img')) ){
            $shop->update([
                'name' => $request->name2,
                'area_id' => $request->area_id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'opening_hour' => $request->opening_hour,
                'holiday' => $request->holiday,
                'tel_number' => $request->tel_number,
                'email' => $request->email2,
                'shop_img' => $old_shop_img,
                'shop_img_rename' => $old_shop_img_rename,
                'shop_url' => $request->shop_url,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
            ]);

        } else {

            Storage::delete('public/shopimg/'.$old_shop_img_rename);
            $s = Str::uuid();

            Storage::putFileAs('public/shopimg', $request->file('shop_img'), $s.'.'.$request->shop_img->extension());
            $file_path = $s.'.'.$request->shop_img->extension();

            $file_name = $request->file('shop_img')->getClientOriginalName();

            $shop->update([
                'name' => $request->name2,
                'area_id' => $request->area_id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'opening_hour' => $request->opening_hour,
                'holiday' => $request->holiday,
                'tel_number' => $request->tel_number,
                'email' => $request->email2,
                'shop_img' => $file_name,
                'shop_img_rename' => $file_path,
                'shop_url' => $request->shop_url,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
            ]);
        }

        $shop->tags()->sync($request->tag_ids);

        return redirect('/shop/done');
    }

    public function show()
    {
        return view('shop_done');
    }

    public function destroy($shop_id)
    {
        $file_path = Shop::find($shop_id)->shop_img_rename;
        Storage::delete('public/shopimg/'.$file_path);
        Shop::find($shop_id)->delete();

        return redirect('/shop/done');
    }
}