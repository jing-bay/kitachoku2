@extends ('layouts.admin-header')
@section ('admin-header')
<div class="register">
  <p class="register__ttl">ログイン</p>
  <form action="/admin/login" method="post">
    @csrf
    <div class="register__content">
      <table class="register__inner">
        <tr>
          <td class="register__content-ttl">メールアドレス</td>
          <td class="register__content-item">
            @error('email')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="email" value="{{ old('email') }}">
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">パスワード</td>
          <td class="register__content-item">
            @error('password')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="password" name="password">
          </td>
        </tr>
      </table>
      <div class="login__password-reset">パスワードを忘れた、変更したい場合は<a href="/admin/forgot-password">こちら</a>から</div>
    </div>
    <div class="register__btn">
      <button class="register__btn-form" type="submit">ログイン</button>
    </div>
  </form>
</div>
@endsection
