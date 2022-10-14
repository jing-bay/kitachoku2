@extends ('layouts.shopadmin-header')
@section ('shopadmin-header')
<div class="shopadmin">
  <div class="shopadmin__ttl-admin">店舗代表者設定</div>
  <form class="shopadmin__content-admin" method="post" action="/shopadmin/update" id="shopadmin-update">
    @csrf
    <ul class="shopadmin__admin-inner">
      <li class="shopadmin__admin-item">
        @error('name')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <p class="shopadmin__admin-heading">名前</p>
        <input type="text" name="name" value="{{ $shop_admin->name }}">
      </li>
      <li class="shopadmin__admin-item">
        @error('email')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <p class="shopadmin__admin-heading">メールアドレス</p>
        <input type="text" name="email" value="{{ $shop_admin->email }}">
      </li>
    </ul>
  </form>
  <div class="shopadmin__admin-bottom">
    <div class="shopadmin__admin-bottomleft"><button type="submit" form="shopadmin-update" class="shopadmin__admin-changebtn">変更する</button></div>
    <form action="/shopadmin/destroy" method="post">
      <button type="submit" class="shopadmin__admin-deletebtn">削除する</button>
    </form>
  </div>
  <div class="shopadmin__ttl-shopsetting">店舗設定</div>
  @if(empty($shop))
  <form class="shopadmin__shopsetting-content h-adr" id="shop" method="post" action="/shop" enctype="multipart/form-data">
  @else
  <form class="shopadmin__shopsetting-content h-adr" id="shop-update" method="post" action="/shop/update/{{ $shop->id }}" enctype="multipart/form-data">
  @endif
  @csrf
    <span class="p-country-name" style="display:none;">Japan</span>
    <ul class="shopadmin__shopsetting-inner">
      <li class="shopadmin__shopsetting-heading">店舗名</li>
      <li class="shopadmin__shopsetting-input">
        @error('name2')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="name2" value="{{ !empty($shop) ? $shop->name : old('name2') }}">
      </li>
      <li class="shopadmin__shopsetting-heading">エリア</li>
      <li class="shopadmin__shopsetting-input">
        @error('area_id')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <select name="area_id">
          @foreach($areas as $area)
          @if(!empty($shop))
          <option value="{{ $area->id }}" {{ $area->id == $shop->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
          @else
          <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
          @endif
          @endforeach
        </select>
      </li>
      <li class="shopadmin__shopsetting-heading">郵便番号</li>
      <li class="shopadmin__shopsetting-input">
        @error('postal_code')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="postal_code" class="p-postal-code"  value="{{ !empty($shop) ? $shop->postal_code : old('postal_code') }}" onblur="toHalfWidth(this)">
      </li>
      <li class="shopadmin__shopsetting-heading">住所</li>
      <li class="shopadmin__shopsetting-input">
        @error('address')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" class="p-region p-locality p-street-address p-extended-address" name="address"  value="{{ !empty($shop) ? $shop->address : old('address') }}">
      </li>
      <li class="shopadmin__shopsetting-heading">営業時間</li>
      <li class="shopadmin__shopsetting-input">
        @error('opening_hour')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="opening_hour" value="{{ !empty($shop) ? $shop->opening_hour : old('opening_hour') }}">
      </li>
      <li class="shopadmin__shopsetting-heading">定休日</li>
      <li class="shopadmin__shopsetting-input">
        @error('holiday')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="holiday" value="{{ !empty($shop) ? $shop->holiday : old('holiday') }}">
      </li>
      <li class="shopadmin__shopsetting-heading">店舗URL</li>
      <li class="shopadmin__shopsetting-input">
        @error('shop_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="shop_url" value="{{ !empty($shop) ? $shop->shop_url : old('shop_url') }}">
      </li>
      <li class="shopadmin__shopsetting-heading">FacebookURL</li>
      <li class="shopadmin__shopsetting-input">
        @error('facebook_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="facebook_url"  value="{{ !empty($shop) ? $shop->facebook_url : old('facebook_url') }}">
      </li>
      <li class="shopadmin__shopsetting-heading">TwitterURL</li>
      <li class="shopadmin__shopsetting-input">
        @error('twitter_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="twitter_url" value="{{ !empty($shop) ? $shop->twitter_url : old('twitter_url') }}">
      </li>
      <li class="shopadmin__shopsetting-heading">店舗画像</li>
      <li class="shopadmin__shopsetting-input">
        @error('shop_img')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <label class="shopadmin__shopsetting-file shopadmin__img">
          <input type="file" name="shop_img">ファイルを選択
        </label>
          <p id="img_name" class="shopadmin__img-name">{{ !empty($shop) ? $shop->shop_img : '' }}</p>
      </li>
      <li class="shopadmin__shopsetting-heading">電話番号</li>
      <li class="shopadmin__shopsetting-input">
        @error('tel_number')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="tel_number" value="{{ !empty($shop) ? $shop->tel_number : old('tel_number') }}" onblur=toHalfWidth(this)>
      </li>
      <li class="shopadmin__shopsetting-heading">メールアドレス</li>
      <li class="shopadmin__shopsetting-input">
        @error('email2')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="email2" value="{{ !empty($shop) ? $shop->email : old('email2') }}">
      </li>
    </ul>
    <div class="shopadmin__shopsetting-tags">
      <div class="shopadmin__shopsetting-tag-heading">タグ</div>
      <ul class="search__tags">
        @foreach($tags as $tag)
        <li class="search__tag">
          @if(!empty($shop))
          <input type="checkbox" name="tag_ids[]" id="{{ $tag->name }}" value="{{ $tag->id }}" {{ in_array($tag->id, $tagIds) ? 'checked' : '' }}>
          @else
          <input type="checkbox" name="tag_ids[]" id="{{ $tag->name }}" value="{{ $tag->id }}" {{ !empty(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? 'checked' : '' }}>
          @endif
          <label for="{{ $tag->name }}" class="search__tag-label" >{{ $tag->name }}</label>
        </li>
        @endforeach
      </ul>
    </div>
    <div class="shopadmin__shopsetting-overview">
      <label for="overview">店舗概要</label>
      @error('overview')
      <p class="register__content-error">{{ $message }}</p>
      @enderror
      <textarea name="overview">{{ !empty($shop) ? $shop->overview : old('overview') }}</textarea>
    </div>
  </form>
  @if(empty($shop))
  <div><button class="shopadmin__shop-btn" form="shop">登録する</button></div>
  @else
  <div class="shopadmin__admin-bottom">
    <div class="shopadmin__admin-bottomleft"><button class="shopadmin__admin-changebtn" form="shop-update">変更する</button></div>
    <form action="/shop/destroy/{{ $shop->id }}" method="post">
      @csrf
      <button class="shopadmin__admin-deletebtn">削除する</button>
    </form>
  </div>
  @endif
  <form class="shopadmin__top-reservation" action="/reservation/search" method="get">
    @csrf
    <div class="shopadmin__ttl-reservation">予約一覧</div>
    @if(!empty($shop))
    <div class="mypage__visited-search-na">
      <div class="mypage__visited-search-name">
        <input class="mypage__visited-searchbox--name" type="text" name="search_name" placeholder= "{{ !empty($search_name) ? '': '氏名で検索' }}" value="{{ !empty($search_name) ? $search_name : '' }}">
      </div>
      <div class="mypage__visited-search-area">
        <select name="search_coupon" class="mypage__visited-searchbox--area" onchange="changeColor(this)">
          <option value="">クーポンを選択</option>
          @foreach ($coupons as $coupon)
          <option value="{{ $coupon->id }}" {{ !empty($search_coupon)&&($coupon->id == $search_coupon) ? 'selected' : '' }}>{{ $coupon->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="mypage__visited-search-date">
      <div class="mypage__visited-search-from">
        来店日：<input type="date" name="search_from_date" onchange="changeColor(this)" value="{{ !empty($search_from_date) ? $search_from_date : '' }}">
      </div>
      <div class="mypage__visited-search-to">
        〜<input type="date" name="search_to_date" onchange="changeColor(this)" value="{{ !empty($search_to_date) ? $search_to_date : '' }}">
      </div>
    </div>
    <div class="mypage__visited-search-btn">
      <button type="submit" class="mypage__visited-btn">検索</button>
    </div>
    @endif
  </form>
  <div class="shopadmin__reservation-content">
    <table class="shopadmin__reservation-inner">
      <tr class="shopadmin__reservation-item">
        <td class="shopadmin__reservation-item-name">氏名</li>
        <td class="shopadmin__reservation-item-date">来店日時</td>
        <td class="shopadmin__reservation-item-coupon">クーポン名</td>
        <td class="shopadmin__reservation-item-reservation">予約日時</td>
        <td class="shopadmin__reservation-item-btn">削除</td>
      </tr>
        @if(!empty($shop))
        @foreach($reservations as $reservation)
      <tr class="shopadmin__reservation-item">
        <td class="shopadmin__reservation-item-name">{{ $reservation->user->name }}</td>
        <td class="shopadmin__reservation-item-date">{{ $reservation->reservation_date }} {{ substr($reservation->reservation_time, 0, 5) }}</td>
        <td class="shopadmin__reservation-item-coupon">{{ $reservation->coupon->name }}</td>
        <td class="shopadmin__reservation-item-reservation">{{ substr($reservation->updated_at, 0, 16) }}</td>
        <td class="shopadmin__reservation-item-btn">
          <form action="/reservation/destroy/{{ $reservation->id }}" method="post">
            @csrf
            <button type="submit">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
      @endif
    </table>
  </div>
  <div class="shopadmin__ttl-coupon">クーポン一覧</div>
  <div class="shopadmin__coupon-content">
    <table class="shopadmin__coupon-inner">
      <tr class="shopadmin__coupon-item">
        <td class="shopadmin__coupon-name">クーポン名</td>
        <td class="shopadmin__coupon-add"></td>
      </tr>
      @if(!empty($shop))
      <tr class="shopadmin__coupon-item">
        <form method="post" action="/coupon">
          @csrf
          <input type="hidden" value="{{ $shop->id }}" name="shop_id">
          <td class="shopadmin__coupon-name">
            @error('name3')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="name3" placeholder="クーポン名を記入">
          </td>
          <td class="shopadmin__coupon-add"><button type="submit">追加</button></td>
        </form>
      </tr>
      @endif
      @if(!empty($coupons))
      @foreach($coupons as $coupon)
      <tr class="shopadmin__coupon-item">
        <form method="post" action="/coupon/destroy/{{ $coupon->id }}">
          @csrf
          <td class="shopadmin__coupon-name">{{ $coupon->name }}</td>
          <td class="shopadmin__coupon-delete"><button type="submit">削除</button></td>
        </form>
      </tr>
      @endforeach
      @endif
    </table>
  </div>
</div>
@endsection