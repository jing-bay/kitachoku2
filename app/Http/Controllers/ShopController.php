<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Area;
use App\Models\Tag;
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
    $file_name = $request->file('shop_img')->getClientOriginalName();
    $img_jpg = Image::make($request->file('shop_img'))->encode('jpg');
    if ( app()->isLocal() ) {
        Storage::put('public/shopimg/'.$file_name.'.jpg', $img_jpg);
    } else {
        Storage::disk('s3')->put($file_name.'.jpg', $img_jpg, 'public');
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
            'shop_img' => $file_name.'.jpg',
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

            $file_name = $request->file('shop_img')->getClientOriginalName();
            $img_jpg = Image::make($request->file('shop_img'))->encode('jpg');
            
            if ( app()->isLocal() ) {
                Storage::put('public/shopimg/'.$file_name.'.jpg', $img_jpg);
            } else {
                Storage::disk('s3')->put($file_name.'.jpg', $img_jpg, 'public');
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
                'shop_img' => $file_name.'.jpg',
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

            $file_name = $request->file('shop_img')->getClientOriginalName();
            $img_jpg = Image::make($request->file('shop_img'))->encode('jpg');
            if ( app()->isLocal() ) {
                Storage::put('public/shopimg/'.$file_name.'.jpg', $img_jpg);
            } else {
                Storage::disk('s3')->put($file_name.'.jpg', $img_jpg, 'public');
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
                'shop_img' => $file_name.'.jpg',
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