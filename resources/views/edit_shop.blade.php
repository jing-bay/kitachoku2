<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>キタチョク</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <div class="header__left">
        <div class="header__logo">
          <a href="/"><img src="{{ asset('images/logo.jpg') }}" alt="キタチョク"></a>
        </div>
      </div>
      <div class="header__right">
        @if(Auth::guard('admin')->check())
        <form action="/admin/logout" method="post" class="header__menu--right">
          @csrf
          <button type="submit" class="header__menu-logout">ログアウト</button>
        </form>
        <div class="header__menu--right">
          <a href="/admin/settings">管理ページ</a>
        </div>
        @else
        <div class="header__menu--right">
          <a href="/mypage">マイページ</a>
        </div>
        <form action="/logout" method="post" class="header__menu--right">
          @csrf
          <button type="submit" class="header__menu-logout">ログアウト</button>
        </form>
        @endif
      </div>
      <div class="header__ham-menu" id="js-ham">
        <ul class="header__list">
          @if(Auth::guard('admin')->check())
          <li class="header__ham-item">
            <form action="/admin/logout" method="post">
              @csrf
              <button type="submit" class="header__menu-logout">ログアウト</button>
            </form>
          </li>
          <li class="header__ham-item"><a href="/admin/settings">管理ページ</a></li>
          @else
          <li class="header__ham-item"><a href="/mypage">マイページ</a></li>
          <li class="header__ham-item">
            <form action="/logout" method="post">
              @csrf
              <button type="submit" class="header__menu-logout">ログアウト</button>
            </form>
          </li>
          @endif
        </ul>
      </div>
      <div class="header__menubtn" id="menubtn">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </header>
<div class="shopedit">
  <div class="shopedit__ttl-shopsetting">店舗設定</div>
  <form class="shopedit__shopsetting-content h-adr" id="shop-update" method="post" action="/shop/update/{{ $shop->id }}" enctype="multipart/form-data">
    @csrf
    <span class="p-country-name" style="display:none;">Japan</span>
    <ul class="shopedit__shopsetting-inner">
      <li class="shopedit__shopsetting-heading">店舗名</li>
      <li class="shopedit__shopsetting-input">
        @error('name2')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="name2" value="{{ !empty($shop) ? $shop->name : old('name2') }}">
      </li>
      <li class="shopedit__shopsetting-heading">エリア</li>
      <li class="shopedit__shopsetting-input">
        @error('area_id')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <select name="area_id">
          @foreach($areas as $area)
          <option value="{{ $area->id }}" {{ $area->id == $shop->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
          @endforeach
        </select>
      </li>
      <li class="shopedit__shopsetting-heading">郵便番号</li>
      <li class="shopedit__shopsetting-input">
        @error('postal_code')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="postal_code" class="p-postal-code"  value="{{ !empty($shop) ? $shop->postal_code : old('postal_code') }}" onblur="toHalfWidth(this)">
      </li>
      <li class="shopedit__shopsetting-heading">住所</li>
      <li class="shopedit__shopsetting-input">
        @error('address')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" class="p-region p-locality p-street-address p-extended-address" name="address"  value="{{ !empty($shop) ? $shop->address : old('address') }}">
      </li>
      <li class="shopedit__shopsetting-heading">営業時間</li>
      <li class="shopedit__shopsetting-input">
        @error('opening_hour')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="opening_hour"  value="{{ !empty($shop) ? $shop->opening_hour : old('opening_hour') }}">
      </li>
      <li class="shopedit__shopsetting-heading">定休日</li>
      <li class="shopedit__shopsetting-input">
        @error('holiday')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="holiday"  value="{{ !empty($shop) ? $shop->holiday : old('holiday') }}">
      </li>
      <li class="shopedit__shopsetting-heading">店舗URL</li>
      <li class="shopedit__shopsetting-input">
        @error('shop_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="shop_url"  value="{{ !empty($shop) ? $shop->shop_url : old('shop_url') }}">
      </li>
      <li class="shopedit__shopsetting-heading">FacebookURL</li>
      <li class="shopedit__shopsetting-input">
        @error('facebook_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="facebook_url"  value="{{ !empty($shop) ? $shop->facebook_url : old('facebook_url') }}">
      </li>
      <li class="shopedit__shopsetting-heading">TwitterURL</li>
      <li class="shopedit__shopsetting-input">
        @error('twitter_url')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="twitter_url"  value="{{ !empty($shop) ? $shop->twitter_url : old('twitter_url') }}">
      </li>
      <li class="shopedit__shopsetting-heading">店舗画像</li>
      <li class="shopedit__shopsetting-input">
        @error('shop_img')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <label class="shopedit__shopsetting-file shopedit__img">
          <input type="file" name="shop_img">ファイルを選択
        </label>
          <p id="img_name" class="shopedit__img-name">{{ !empty($shop) ? $shop->shop_img : '' }}</p>
      </li>
      <li class="shopedit__shopsetting-heading">電話番号</li>
      <li class="shopedit__shopsetting-input">
        @error('tel_number')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="tel_number" value="{{ !empty($shop) ? $shop->tel_number : old('tel_number') }}" onblur="toHalfWidth(this)">
      </li>
      <li class="shopedit__shopsetting-heading">メールアドレス</li>
      <li class="shopedit__shopsetting-input">
        @error('email2')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <input type="text" name="email2"  value="{{ !empty($shop) ? $shop->email : old('email2') }}">
      </li>
    </ul>
    <div class="shopedit__shopsetting-tags">
      <div class="shopedit__shopsetting-tag-heading">タグ</div>
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
  </form>
  <div class="shopedit__admin-bottom">
    <div class="shopedit__admin-bottomleft"><button class="shopedit__admin-changebtn" form="shop-update">変更する</button></div>
    @if(Auth::guard('admin')->check())
    <form action="/shop/destroy/{{ $shop->id }}" method="post">
      @csrf
      <button class="shopedit__admin-deletebtn">削除する</button>
    </form>
    @endif
  </div>
</div>
<footer class="footer">
    <div class="footer__content">
      <p class="footer__txt">
        一般のお客様からのお問い合わせ:aaaa@mail.co.jp
      </p>
      <p class="footer__txt">
        農産物直売所の方からのお問い合わせ、掲載依頼:bbbb@mail.co.jp
      </p>
      <p class="footer__copyright">
        &copy;2022 jing-bay 
      </p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/shopedit.js') }}"></script>
</body>
</html>