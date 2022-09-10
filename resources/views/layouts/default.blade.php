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
        <div class="header__menu--left">
          <a href="/#concept">キタチョクとは？</a>
        </div>
      </div>
      <div class="header__right">
        @auth
        <div class="header__menu--right">
          <a href="/mypage">マイページ</a>
        </div>
        <form action="/logout" method="POST" class="header__menu--right">
          @csrf
          <button type="submit">ログアウト</button>
        </form>
        @endauth
        @guest
        <div class="header__menu--right">
          <a href="/login">ログイン</a>
        </div>
        <div class="header__menu--right">
          <a href="/register">会員登録</a>
        </div>
        @endguest
      </div>

      <div class="header__ham-menu" id="js-ham">
        <ul class="header__list">
          @guest
          <li class="header__ham-item"><a href="/register">会員登録</a></li>
          <li class="header__ham-item"><a href="/login">ログイン</a></li>
          @endguest
          @auth
          <li class="header__ham-item"><a href="/mypage">マイページ</a></li>
          <li class="header__ham-item">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit">ログアウト</button>
            </form>
          </li>
          @endauth
        </ul>
      </div>
      <div class="header__menubtn" id="menubtn">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </header>
  @yield('content')
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
</body>
</html>