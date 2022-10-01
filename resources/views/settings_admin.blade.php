@extends ('layouts.admin-header')

@section ('admin-header')
<div class="shopadmin">
  <div class="shopadmin__ttl-admin">代表者設定</div>
  <form class="shopadmin__content-admin" method="post" action="/admin/update" id="admin-update">
    @csrf
    <ul class="shopadmin__admin-inner">
      <li class="shopadmin__admin-item">
        @error('name')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <p class="shopadmin__admin-heading">名前</p>
        <input type="text" name="name" value="{{ $admin->name }}">
      </li>
      <li class="shopadmin__admin-item">
        @error('email')
        <p class="register__content-error">{{ $message }}</p>
        @enderror
        <p class="shopadmin__admin-heading">メールアドレス</p>
        <input type="text" name="email" value="{{ $admin->email }}">
      </li>
    </ul>
  </form>
  <div class="shopadmin__admin-bottom">
    <div class="shopadmin__admin-bottomleft"><button type="submit" form="admin-update" class="shopadmin__admin-changebtn">変更する</button></div>
    <form action="/admin/destroy" method="post">
      @csrf
      <button type="submit" class="shopadmin__admin-deletebtn">削除する</button>
    </form>
  </div>

  <form class="shopadmin__top-reservation" action="/search/shop" method="get">
    @csrf
    <div class="shopadmin__ttl-reservation">店舗検索</div>
    <div class="admin__shop-top">
      <div class="admin__shop-name">
        <input class="mypage__visited-searchbox--name" type="text" name="search_shop" placeholder= "{{ !empty($search_shop) ? '': '店舗名で検索' }}" value="{{ !empty($search_shop) ? $search_shop : '' }}">
      </div>
      <div class="admin__shop-area">
        <select name="search_area" class="mypage__visited-searchbox--area" onchange="changeColor(this)">
          <option value="">エリアを選択</option>
          @foreach ($areas as $area)
          <option value="{{ $area->id }}" {{ !empty($search_area)&&($area->id == $search_area) ? 'selected' : '' }}>{{ $area->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="mypage__visited-search-btn">
      <button type="submit" class="mypage__visited-btn">検索</button>
    </div>
  </form>
  <div class="shopadmin__reservation-content">
    <table class="shopadmin__reservation-inner">
      <tr class="shopadmin__reservation-item">
        <td class="shopadmin__reservation-item-name">店舗名</li>
        <td class="shopadmin__reservation-item-date">エリア</td>
        <td class="shopadmin__reservation-item-coupon">住所</td>
        <td class="shopadmin__reservation-item-reservation">代表者名</td>
        <td class="shopadmin__reservation-item-btn">削除</td>
      </tr>
      @foreach($shops as $shop)
      <tr class="shopadmin__reservation-item">
        <td class="shopadmin__reservation-item-name"><a href="/admin/settings/shopdetail/{{ $shop->id }}">{{ $shop->name }}</a></td>
        <td class="shopadmin__reservation-item-date">{{ $shop->area->name }}</td>
        <td class="shopadmin__reservation-item-coupon">{{ $shop->address }}</td>
        <td class="shopadmin__reservation-item-reservation">{{ $shop->shopAdmin->name }}</td>
        <td class="shopadmin__reservation-item-btn">
          <form action="/shop/destroy/{{ $shop->id }}" method="post">
            @csrf
            <button type="submit">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>

  <form class="shopadmin__top-reservation" action="/search/shopadmin" method="get">
    @csrf
    <div class="shopadmin__ttl-reservation">店舗代表者検索</div>
    <div class="admin__shop-top">
      <div class="admin__shop-name">
        <input class="mypage__visited-searchbox--name" type="text" name="search_name" placeholder= "{{ !empty($search_name) ? '': '代表者名で検索' }}" value="{{ !empty($search_name) ? $search_name : '' }}">
      </div>
      <div class="admin__shop-name">
        <input class="mypage__visited-searchbox--name" type="text" name="search_shop2" placeholder= "{{ !empty($search_shop2) ? '': '店舗名で検索' }}" value="{{ !empty($search_shop2) ? $search_shop2 : '' }}">
      </div>
      <div class="admin__shop-area">
        <input class="mypage__visited-searchbox--name" type="text" name="search_email" placeholder= "{{ !empty($search_email) ? '': 'メールアドレスで検索' }}" value="{{ !empty($search_email) ? $search_email : '' }}">
      </div>
    </div>
    <div class="mypage__visited-search-btn">
      <button type="submit" class="mypage__visited-btn">検索</button>
    </div>
  </form>
  <div class="shopadmin__reservation-content">
    <table class="shopadmin__reservation-inner">
      <tr class="shopadmin__reservation-item">
        <td class="shopadmin__reservation-item-name">代表者名</li>
        <td class="shopadmin__reservation-item-date">店舗名</td>
        <td class="shopadmin__reservation-item-coupon">メールアドレス</td>
        <td class="shopadmin__reservation-item-reservation">変更</td>
        <td class="shopadmin__reservation-item-btn">削除</td>
      </tr>
      @foreach($shop_admins as $shop_admin)
      <tr class="shopadmin__reservation-item">
        <td class="shopadmin__reservation-item-name">{{ $shop_admin->name }}</td>
        <td class="shopadmin__reservation-item-date">{{ !empty($shop_admin->shop->name) ?  $shop_admin->shop->name : '' }}</td>
        <td class="shopadmin__reservation-item-coupon">{{ $shop_admin->email }}</td>
        <td class="shopadmin__reservation-item-reservation">
          <a href="/admin/settings/shopadmin/{{ $shop_admin->id }}">変更</a>
        </td>
        <td class="shopadmin__reservation-item-btn">
          <form action="/shopadmin/destroy" method="post">
            @csrf
            <input type="hidden" value="{{ $shop_admin->id }}" name="shopadmin_id">
            <button type="submit">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>

  <form class="shopadmin__top-reservation" action="/search/user" method="get">
    @csrf
    <div class="shopadmin__ttl-reservation">ユーザー検索</div>
    <div class="admin__shop-top">
      <div class="admin__shop-name">
        <input class="mypage__visited-searchbox--name" type="text" name="search_name2" placeholder= "{{ !empty($search_name2) ? '': 'ユーザー名で検索' }}" value="{{ !empty($search_name2) ? $search_name2 : '' }}">
      </div>
      <div class="admin__shop-name">
        <input class="mypage__visited-searchbox--name" type="text" name="search_nickname" placeholder= "{{ !empty($search_nickname) ? '': 'ニックネームで検索' }}" value="{{ !empty($search_nickname) ? $search_nickname : '' }}">
      </div>
      <div class="admin__shop-area">
        <input class="mypage__visited-searchbox--name" type="text" name="search_email2" placeholder= "{{ !empty($search_email2) ? '': 'メールアドレスで検索' }}" value="{{ !empty($search_email2) ? $search_email2 : '' }}">
      </div>
    </div>
    <div class="mypage__visited-search-btn">
      <button type="submit" class="mypage__visited-btn">検索</button>
    </div>
  </form>
  <div class="shopadmin__reservation-content">
    <table class="shopadmin__reservation-inner">
      <tr class="shopadmin__reservation-item">
        <td class="shopadmin__reservation-item-name">ユーザー名</li>
        <td class="shopadmin__reservation-item-date">ニックネーム</td>
        <td class="shopadmin__reservation-item-coupon">メールアドレス</td>
        <td class="shopadmin__reservation-item-reservation">変更</td>
        <td class="shopadmin__reservation-item-btn">削除</td>
      </tr>
      @foreach($users as $user)
      <tr class="shopadmin__reservation-item">
        <td class="shopadmin__reservation-item-name">{{ $user->name }}</td>
        <td class="shopadmin__reservation-item-date">{{ $user->nickname }}</td>
        <td class="shopadmin__reservation-item-coupon">{{ $user->email }}</td>
        <td class="shopadmin__reservation-item-reservation">
          <a href="/admin/settings/user/{{ $user->id }}">変更</a>
        </td>
        <td class="shopadmin__reservation-item-btn">
          <form action="/user/destroy" method="post">
            @csrf
            <input type="hidden" value="{{ $user->id }}" name="user_id">
            <button type="submit">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>

  <div class="shopadmin__ttl-coupon">新着情報</div>
  <div class="shopadmin__coupon-content">
    <table class="shopadmin__coupon-inner">
      <tr class="shopadmin__coupon-item">
        <td class="shopadmin__coupon-name">新着情報</td>
        <td class="shopadmin__coupon-add">更新日</td>
        <td class="shopadmin__coupon-add"></td>
      </tr>
      <tr class="shopadmin__coupon-item">
        <form action="/notice" method="post">
          @csrf
          <td class="shopadmin__coupon-name">
            @error('content')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="content" placeholder= "新着情報を記入">
          </td>
          <td></td>
          <td class="shopadmin__coupon-add"><button type="submit">追加</button></td>
        </form>
      </tr>
      @foreach($notices as $notice)
      <tr class="shopadmin__coupon-item">
        <form method="post" action="/notice/destroy/{{ $notice->id }}">
          @csrf
          <td class="shopadmin__coupon-name">{{ $notice->content }}</td>
          <td>{{ $notice->created_at }}</td>
          <td class="shopadmin__coupon-delete"><button type="submit">削除</button></td>
        </form>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection