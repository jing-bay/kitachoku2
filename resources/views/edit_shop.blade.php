@extends ('layouts.admin-header')
@section ('admin-header')
<div class="shopedit">
  <div class="shopadmin__ttl-shopsetting">店舗設定</div>
  <form class="shopadmin__shopsetting-content h-adr" id="shop-update" method="post" action="/shop/update/{{ $shop->id }}" enctype="multipart/form-data">
    @csrf
    <span class="p-country-name" style="display:none;">Japan</span>
    <input type="hidden" name="shop_admin_id" value="{{ $shop->shop_admin_id }}">
    <ul class="shopadmin__shopsetting-inner">
      <li class="shopadmin__shopsetting-heading">店舗名</li>
      <li class="shopadmin__shopsetting-input">
        @error('name2')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="name2" value="{{ !empty($shop) ? $shop->name : '' }}">
      </li>
      <li class="shopadmin__shopsetting-heading">エリア</li>
      <li class="shopadmin__shopsetting-input">
        @error('area_id')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <select name="area_id">
          @foreach($areas as $area)
          <option value="{{ $area->id }}" {{ $area->id == $shop->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
          @endforeach
        </select>
      </li>
      <li class="shopadmin__shopsetting-heading">郵便番号</li>
      <li class="shopadmin__shopsetting-input">
        @error('postal_code')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="postal_code" class="p-postal-code"  value="{{ !empty($shop) ? $shop->postal_code : '' }}">
      </li>
      <li class="shopadmin__shopsetting-heading">住所</li>
      <li class="shopadmin__shopsetting-input">
        @error('address')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" class="p-region p-locality p-street-address p-extended-address" name="address"  value="{{ !empty($shop) ? $shop->address : '' }}">
      </li>
      <li class="shopadmin__shopsetting-heading">営業時間</li>
      <li class="shopadmin__shopsetting-input">
        @error('opening_hour')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="opening_hour"  value="{{ !empty($shop) ? $shop->opening_hour : '' }}">
      </li>
      <li class="shopadmin__shopsetting-heading">定休日</li>
      <li class="shopadmin__shopsetting-input">
        @error('holiday')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="holiday"  value="{{ !empty($shop) ? $shop->holiday : '' }}">
      </li>
      <li class="shopadmin__shopsetting-heading">店舗URL</li>
      <li class="shopadmin__shopsetting-input">
        @error('shop_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="shop_url"  value="{{ !empty($shop) ? $shop->shop_url : '' }}">
      </li>
      <li class="shopadmin__shopsetting-heading">FacebookURL</li>
      <li class="shopadmin__shopsetting-input">
        @error('facebook_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="facebook_url"  value="{{ !empty($shop) ? $shop->facebook_url : '' }}">
      </li>
      <li class="shopadmin__shopsetting-heading">TwitterURL</li>
      <li class="shopadmin__shopsetting-input">
        @error('twitter_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="twitter_url"  value="{{ !empty($shop) ? $shop->twitter_url : '' }}">
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
        <input type="text" name="tel_number" value="{{ !empty($shop) ? $shop->tel_number : ''}}">
      </li>
      <li class="shopadmin__shopsetting-heading">メールアドレス</li>
      <li class="shopadmin__shopsetting-input">
        @error('email2')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="email2"  value="{{ !empty($shop) ? $shop->email : ''}}">
      </li>
    </ul>
    <div class="shopadmin__shopsetting-tags">
      <div class="shopadmin__shopsetting-tag-heading">タグ</div>
      <ul class="search__tags">
        @foreach($tags as $tag)
        <li class="search__tag">
          <input type="checkbox" name="tag_ids[]" id="{{ $tag->name }}" value="{{ $tag->id }}" {{ in_array($tag->id, $tagIds) ? 'checked' : '' }}>
          <label for="{{ $tag->name }}" class="search__tag-label">{{ $tag->name }}</label>
        </li>
        @endforeach
      </ul>
    </div>
    <div class="shopadmin__shopsetting-overview">
      <label for="overview">店舗概要</label>
      @error('overview')
      <p class="register__content-error">{{ $message }}</p>
      @enderror
      <textarea name="overview">{{ !empty($shop) ? $shop->overview : '' }}</textarea>
    </div>
  </form>
  <div class="shopadmin__admin-bottom">
    <div class="shopadmin__admin-bottomleft"><button class="shopadmin__admin-changebtn" form="shop-update">変更する</button></div>
    <form action="/shop/destroy/{{ $shop->id }}" method="post">
      @csrf
      <button class="shopadmin__admin-deletebtn">削除する</button>
    </form>
  </div>
</div>
@endsection