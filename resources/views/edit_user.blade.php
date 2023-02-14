@extends ('layouts.admin-header')
@section ('admin-header')
<div class="register">
  <p class="register__ttl">設定変更</p>
  <div class="register__content">
    <table class="register__inner">
      <form action="/user/update" method="post" id="update_{{ $user->id }}">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <tr>
          <td class="register__content-ttl">名前</td>
          <td class="register__content-item">
            @error('name')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="name" value="{{ $user->name }}">
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">ニックネーム</td>
          <td class="register__content-item">
            @error('nickname')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="nickname" value="{{ $user->nickname }}">
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">メールアドレス</td>
          <td class="register__content-item">
            @error('email')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="email" value="{{ $user->email }}">
          </td>
        </tr>
      </form>
    </table>
  </div>
  <div class="mypage__bottom">
    <div class="mypage__btn">
      <button type="submit" form="update_{{ $user->id }}" class="mypage__update">変更する</button>
    </div>
    <form action="/user/destroy" method="post" class="mypage__btn">
      @csrf
      <input type="hidden" name="user_id" value="{{ $user->id }}">
      <button type="submit" class="mypage__delete">退会する</button>
    </form>
  </div>
</div>
@endsection