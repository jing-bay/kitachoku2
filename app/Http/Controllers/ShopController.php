<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\ShopRequest;
use App\Http\Requests\UpdateShopRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function store(ShopRequest $request)
    {
        if ( app()->isLocal() ) {
            $file_path = $request->file('shop_img')->getClientOriginalName();
            Storage::putFileAs('public/shopimg', $request->file('shop_img'), $file_path);
        } else {
            $file_path = Storage::disk('s3')->putFile('shopimg', $request->file('shop_img'), 'public');
        }

        $shop = Shop::create([
            'name' => $request->name2,
            'shop_admin_id' => Auth::guard('shopadmin')->id(),
            'area_id' => $request->area_id,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'opening_hour' => $request->opening_hour,
            'holiday' => $request->holiday,
            'tel_number' => $request->tel_number,
            'email' => $request->email2,
            'overview' => $request->overview,
            'shop_img' => $file_path,
            'shop_url' => $request->shop_url,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
        ]);

        $shop->tags()->attach($request->tag_ids);
        
        return redirect('/shop/done');
    }

    public function update($shop_id, UpdateShopRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        $shop = Shop::find($shop_id);
        $old_shop_img = $shop->shop_img;
        
        if(empty($request->file('shop_img')) && empty($request->shop_admin_id)) {
            $shop->update([
                'name' => $request->name2,
                'shop_admin_id' => Auth::guard('shopadmin')->id(),
                'area_id' => $request->area_id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'opening_hour' => $request->opening_hour,
                'holiday' => $request->holiday,
                'tel_number' => $request->tel_number,
                'email' => $request->email2,
                'overview' => $request->overview,
                'shop_img' => $old_shop_img,
                'shop_url' => $request->shop_url,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
            ]);

        } else if (empty($request->file('shop_img')) && !empty($request->shop_admin_id)) {
            $shop->update([
                'name' => $request->name2,
                'shop_admin_id' => $request->shop_admin_id,
                'area_id' => $request->area_id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'opening_hour' => $request->opening_hour,
                'holiday' => $request->holiday,
                'tel_number' => $request->tel_number,
                'email' => $request->email2,
                'overview' => $request->overview,
                'shop_img' => $old_shop_img,
                'shop_url' => $request->shop_url,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
            ]);

        } else if (!empty($request->file('shop_img')) && empty($request->shop_admin_id)) {
            if ( app()->isLocal() ) {
                Storage::delete('public/shopimg/'.$old_shop_img);
            } else {
                Storage::disk('s3')->delete($old_shop_img);
            }

            if ( app()->isLocal() ) {
                $file_path = $request->file('shop_img')->getClientOriginalName();
                Storage::putFileAs('public/shopimg', $request->file('shop_img'), $file_path);
            } else {
                $file_path = Storage::disk('s3')->putFile('shopimg', $request->file('shop_img'), 'public');
            }

            $shop->update([
                'name' => $request->name2,
                'shop_admin_id' => Auth::guard('shopadmin')->id(),
                'area_id' => $request->area_id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'opening_hour' => $request->opening_hour,
                'holiday' => $request->holiday,
                'tel_number' => $request->tel_number,
                'email' => $request->email2,
                'overview' => $request->overview,
                'shop_img' => $file_path,
                'shop_url' => $request->shop_url,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
            ]);

        } else {
            if ( app()->isLocal() ) {
                Storage::delete('public/shopimg/'.$old_shop_img);
            } else {
                Storage::disk('s3')->delete($old_shop_img);
            }

            if ( app()->isLocal() ) {
                $file_path = $request->file('shop_img')->getClientOriginalName();
                Storage::putFileAs('public/shopimg', $request->file('shop_img'), $file_path);
            } else {
                $file_path = Storage::disk('s3')->putFile('shopimg', $request->file('shop_img'), 'public');
            }

            $shop->update([
                'name' => $request->name2,
                'shop_admin_id' => $request->shop_admin_id,
                'area_id' => $request->area_id,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'opening_hour' => $request->opening_hour,
                'holiday' => $request->holiday,
                'tel_number' => $request->tel_number,
                'email' => $request->email2,
                'overview' => $request->overview,
                'shop_img' => $file_path,
                'shop_url' => $request->shop_url,
                'facebook_url' => $request->facebook_url,
                'twitter_url' => $request->twitter_url,
            ]);
        };
        
        $shop->tags()->sync($request->tag_ids);

        return redirect('/shop/done');
    }

    public function show()
    {
        return view('shop_done');
    }

    public function destroy($shop_id)
    {
        $shop_img =Shop::find($shop_id)->shop_img;
        
        if ( app()->isLocal() ) {
            Storage::delete('public/shopimg/'.$shop_img);
        } else {
            Storage::disk('s3')->delete($shop_img);
        }

        Shop::find($shop_id)->delete();

        return redirect('/shop/done');
    }
}