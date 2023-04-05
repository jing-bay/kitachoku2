@extends ('layouts.default')
@section ('content')
<div class="shopedit">
  <div class="shopedit__ttl-shopsetting">店舗設定</div>
  <form class="shopedit__shopsetting-content h-adr" id="shop-store" method="post" action="/shop" enctype="multipart/form-data">
    @csrf
    <span class="p-country-name" style="display:none;">Japan</span>
    <ul class="shopedit__shopsetting-inner">
      <li class="shopedit__shopsetting-heading">店舗名</li>
      <li class="shopedit__shopsetting-input">
        @error('name2')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="name2" value="{{ old('name2') }}">
      </li>
      <li class="shopedit__shopsetting-heading">エリア</li>
      <li class="shopedit__shopsetting-input">
        @error('area_id')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <select name="area_id">
          @foreach($areas as $area)
          <option value="{{ $area->id }}">{{ $area->name }}</option>
          @endforeach
        </select>
      </li>
      <li class="shopedit__shopsetting-heading">郵便番号</li>
      <li class="shopedit__shopsetting-input">
        @error('postal_code')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="postal_code" class="p-postal-code" value="{{ old('postal_code') }}" onblur="toHalfWidth(this)">
      </li>
      <li class="shopedit__shopsetting-heading">住所</li>
      <li class="shopedit__shopsetting-input">
        @error('address')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" class="p-region p-locality p-street-address p-extended-address" name="address" value="{{ old('address') }}">
      </li>
      <li class="shopedit__shopsetting-heading">営業時間</li>
      <li class="shopedit__shopsetting-input">
        @error('opening_hour')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="opening_hour" value="{{ old('opening_hour') }}">
      </li>
      <li class="shopedit__shopsetting-heading">定休日</li>
      <li class="shopedit__shopsetting-input">
        @error('holiday')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="holiday" value="{{ old('holiday') }}">
      </li>
      <li class="shopedit__shopsetting-heading">店舗URL</li>
      <li class="shopedit__shopsetting-input">
        @error('shop_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="shop_url" value="{{ old('shop_url') }}">
      </li>
      <li class="shopedit__shopsetting-heading">FacebookURL</li>
      <li class="shopedit__shopsetting-input">
        @error('facebook_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="facebook_url" value="{{ old('facebook_url') }}">
      </li>
      <li class="shopedit__shopsetting-heading">TwitterURL</li>
      <li class="shopedit__shopsetting-input">
        @error('twitter_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="twitter_url" value="{{ old('twitter_url') }}">
      </li>
      <li class="shopedit__shopsetting-heading">店舗画像</li>
      <li class="shopedit__shopsetting-input">
        @error('shop_img')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <label class="shopedit__shopsetting-file shopedit__img">
          <input type="file" name="shop_img">ファイルを選択
        </label>
          <p id="img_name" class="shopedit__img-name"></p>
      </li>
      <li class="shopedit__shopsetting-heading">電話番号</li>
      <li class="shopedit__shopsetting-input">
        @error('tel_number')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="tel_number" value="{{ old('tel_number') }}">
      </li>
      <li class="shopedit__shopsetting-heading">メールアドレス</li>
      <li class="shopedit__shopsetting-input">
        @error('email2')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="email2">
      </li>
    </ul>
    <div class="shopedit__shopsetting-tags">
      <div class="shopedit__shopsetting-tag-heading">タグ</div>
      <ul class="search__tags">
        @foreach($tags as $tag)
        <li class="search__tag">
          <input type="checkbox" name="tag_ids[]" id="{{ $tag->name }}" value="{{ $tag->id }}">
          <label for="{{ $tag->name }}" class="search__tag-label">{{ $tag->name }}</label>
        </li>
        @endforeach
      </ul>
    </div>
  </form>
  <div class="shopedit__admin-bottom">
    <div class="shopedit__admin-bottomleft"><button class="shopedit__admin-changebtn" form="shop-store">登録する</button></div>
  </div>
</div>
@endsection
@section ('add-js')
<script src="{{ asset('js/shopedit.js') }}"></script>
@endsection