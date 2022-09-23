@extends ('layouts.default')
@section ('content')
<div class="register">
  <p class="register__ttl">設定変更</p>
  <div class="register__content">
    <table class="register__inner">
      <form action="/user/update" method="post">
      <tr>
        <td class="register__content-ttl">名前</td>
        <td class="register__content-item">
          @error('name')
          <p class="register__content-error">{{ $message }}</p>
          @enderror
          <input type="text" name="name">
        </td>
      </tr>
      <tr>
        <td class="register__content-ttl">ニックネーム</td>
        <td class="register__content-item">
          @error('nickname')
          <p class="register__content-error">{{ $message }}</p>
          @enderror
          <input type="text" name="nickname">
        </td>
      </tr>
      <tr>
        <td class="register__content-ttl">メールアドレス</td>
        <td class="register__content-item">
          @error('email')
          <p class="register__content-error">{{ $message }}</p>
          @enderror
          <input type="text" name="email">
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
  </div>
  <div class="register__btn">
    <button class="register__btn-form" type="submit">登録する</button>
  </div>
</div>
@endsection
@endsection