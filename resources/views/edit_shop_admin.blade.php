@extends ('layouts.admin-header')
@section ('admin-header')
<div class="shopadmin">
  <div class="shopadmin__ttl-admin">店舗代表者設定</div>
  <form class="shopadmin__content-admin" method="post" action="/shopadmin/update" id="shopadmin-update">
    @csrf
    <input type="hidden" name="id" value="{{ $shop_admin->id }}">
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
      @csrf
      <button type="submit" class="shopadmin__admin-deletebtn">削除する</button>
    </form>
  </div>
@endsection