<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>キタチョク</title>
  <link rel="stylesheet" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <div class="header__left">
        <div class="header__logo">
          <a href="/"><img src="{{ asset('images/logo.jpg') }}" alt="キタチョク"></a>
        </div>
      </div>
    </div>
  </header>
  <div class="thanks">
    <div class="thanks__inner">
      <p class="thanks__txt">
        店舗代表者の削除が完了しました
      </p>
      @if(Auth::guard('admin')->check())
      <button type="button" onclick="location.href='/admin/settings'" class="thanks__backbtn">戻る</button>
      @else
      <button type="button" onclick="location.href='/'" class="thanks__backbtn">戻る</button>
      @endif
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  @yield('add-js')
</body>
</html>