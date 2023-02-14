@extends ('layouts.admin-header')
@section ('admin-header')
<div class="admin">
  <div class="admin__ttl-admin">代表者設定</div>
  <form class="admin__content-admin" method="post" action="/admin/update" id="admin-update">
    @csrf
    <ul class="admin__admin-inner">
      <li class="admin__admin-left">
        <p class="admin__admin-heading">名前</p>
        <div class="admin__admin-input">
          @error('name')
          <p class="register__content-error">{{ $message }}</p>
          @enderror
          <input type="text" name="name" value="{{ $admin->name }}">
        </div>
      </li>
      <li class="admin__admin-right">
        <p class="admin__admin-heading">メールアドレス</p>
        <div class="admin__admin-input">
          @error('email')
          <p class="register__content-error">{{ $message }}</p>
          @enderror
          <input type="text" name="email" value="{{ $admin->email }}">
        </div>
      </li>
    </ul>
  </form>
  <div class="admin__admin-bottom">
    <div class="admin__admin-bottomleft">
      <button type="submit" form="admin-update" class="admin__admin-changebtn">変更する</button>
    </div>
    <form action="/admin/destroy" method="post">
      @csrf
      <button type="submit" class="admin__admin-deletebtn">削除する</button>
    </form>
  </div>

  <form class="admin__top-item" action="/search/shop" method="get">
    @csrf
    <div class="admin__ttl-shop">店舗検索</div>
    <div class="admin__shop-top">
      <div class="admin__shop-name">
        <input class="admin__shop-searchbox" type="text" name="search_shop" placeholder= "{{ !empty($search_shop) ? '': '店舗名で検索' }}" value="{{ !empty($search_shop) ? $search_shop : '' }}">
      </div>
      <div class="admin__shop-area">
        <select name="search_area" class="admin__shop-searchbox--area" onchange="changeColor(this)">
          <option value="">エリアを選択</option>
          @foreach ($areas as $area)
          <option value="{{ $area->id }}" {{ !empty($search_area)&&($area->id == $search_area) ? 'selected' : '' }}>{{ $area->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="admin__visited-search-btn">
      <button type="submit" class="admin__visited-search-btn">検索</button>
    </div>
  </form>
  <div class="admin__shop-content">
    <table class="admin__shop-inner">
      <tr class="admin__shop-item">
        <td class="admin__shop-item-shop">店舗名</li>
        <td class="admin__shop-item-area">エリア</td>
        <td class="admin__shop-item-address">住所</td>
        <td class="admin__shop-item-btn">削除</td>
      </tr>
      @foreach($shops as $shop)
      <tr class="admin__shop-item">
        <td class="admin__shop-item-shop"><a href="/shop/edit/{{ $shop->id }}">{{ $shop->name }} &gt;&gt;</a></td>
        <td class="admin__shop-item-area">{{ $shop->area->name }}</td>
        <td class="admin__shop-item-address">{{ $shop->address }}</td>
        <td class="admin__shop-item-btn">
          <form action="/shop/destroy/{{ $shop->id }}" method="post">
            @csrf
            <button type="submit">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
  <form class="admin__top-item" action="/search/user" method="get">
    @csrf
    <div class="admin__user-top">
      <div class="admin__ttl-user">ユーザー検索</div>
      <div class="admin__user-left">
        <input class="admin__user-searchbox" type="text" name="search_name2" placeholder= "{{ !empty($search_name2) ? '': 'ユーザー名で検索' }}" value="{{ !empty($search_name2) ? $search_name2 : '' }}">
        <input class="admin__user-searchbox" type="text" name="search_nickname" placeholder= "{{ !empty($search_nickname) ? '': 'ニックネームで検索' }}" value="{{ !empty($search_nickname) ? $search_nickname : '' }}">
      </div>
      <div class="admin__user-right">
        <input class="admin__user-searchbox" type="text" name="search_email2" placeholder= "{{ !empty($search_email2) ? '': 'メールアドレスで検索' }}" value="{{ !empty($search_email2) ? $search_email2 : '' }}">
      </div>
      <div class="admin__visited-search-btn">
        <button type="submit" class="admin__visited-search-btn">検索</button>
      </div>
    </div>
  </form>
  <div class="admin__user-content">
    <table class="admin__user-inner">
      <tr class="admin__user-item">
        <td class="admin__user-item-name">ユーザー名</li>
        <td class="admin__user-item-nickname">ニックネーム</td>
        <td class="admin__user-item-email">メールアドレス</td>
        <td class="admin__user-item-change">変更</td>
        <td class="admin__user-item-btn">削除</td>
      </tr>
      @foreach($users as $user)
      <tr class="admin__user-item">
        <td class="admin__user-item-name">{{ $user->name }}</td>
        <td class="admin__user-item-nickname">{{ $user->nickname }}</td>
        <td class="admin__user-item-email">{{ $user->email }}</td>
        <td class="admin__user-item-change">
          <a href="/admin/settings/user/{{ $user->id }}">変更</a>
        </td>
        <td class="admin__user-item-btn">
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
  <div class="admin__ttl-notice">新着情報</div>
  <div class="admin__notice-content">
    <table class="admin__notice-inner">
      <tr class="admin__notice-item">
        <td class="admin__notice-name">新着情報</td>
        <td class="admin__notice-update">更新日</td>
        <td class="admin__notice-add"></td>
      </tr>
      <tr class="admin__notice-item">
        <form action="/notice" method="post">
          @csrf
          <td class="admin__notice-name">
            @error('content')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="content" placeholder= "新着情報を記入">
          </td>
          <td class="admin__notice-update"></td>
          <td class="admin__notice-add"><button type="submit">追加</button></td>
        </form>
      </tr>
      @foreach($notices as $notice)
      <tr class="admin__notice-item">
        <form method="post" action="/notice/destroy/{{ $notice->id }}">
          @csrf
          <td class="admin__notice-name">{{ $notice->content }}</td>
          <td class="admin__notice-update">{{ substr($notice->created_at, 0, 16) }}</td>
          <td class="admin__notice-delete"><button type="submit">削除</button></td>
        </form>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection