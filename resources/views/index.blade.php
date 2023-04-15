@extends ('layouts.default')
@section ('content')
<div class="search">
  <div class="search__inner">
    <p class="search__txt">北海道の農産物直売所ポータルサイト</p>
    <div class="search__logo"><img src="{{ asset('images/logo.jpg') }}" alt="キタチョク"></div>
    <div class="search__tabs">
      <input type="radio" name="search-tab" checked id="tab1" onclick="formSwitch()"><label for="tab1" class="search__tab-text">特徴で検索</label></input>
      <input type="radio" name="search-tab" id="tab2" onclick="formSwitch()"><label for="tab2" class="search__tab-text">エリアで検索</label></input>
      <input type="radio" name="search-tab" id="tab3" onclick="formSwitch()"><label for="tab3" class="search__tab-text">キーワード検索</label></input>
    </div>
    <form action="/search" method="get" id="tagForm" class="search__contents">
      @csrf
      <ul class="search__tags" id="searchTag">
        @foreach($tags as $tag)
        <li class="search__tag">
          <input type="checkbox" name="search_tag[]" id="{{ $tag->name }}" value="{{ $tag->id }}">
          <label for="{{ $tag->name }}" class="search__tag-label">{{ $tag->name }}</label>
        </li>
        @endforeach
      </ul>
      <div class="search__btn">
        <button class="search__btn-form" type="submit">検索</button>
      </div>
    </form>
    <form action="/search" method="get" id="areaForm" class="search__contents">
      @csrf
      <div class="search__areas">
        <select name="search_area" class="search__area">
          @foreach($areas as $area)
          <option value="{{ $area->id }}">{{ $area->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="search__btn">
        <button class="search__btn-form" type="submit">検索</button>
      </div>
    </form>
    <form action="/search" method="get" id="keywordForm" class="search__contents">
      @csrf
      <div class="search__keyword">
        <input type="text" name="search_keyword" placeholder="店舗名・住所キーワード検索" class="search__keyword-input">
      </div>
      <div class="search__btn">
        <button class="search__btn-form" type="submit">検索</button>
      </div>
    </form>
  </div>
</div>
<div class="notice">
  <p class="notice__ttl">新着情報</p>
  @foreach($notices as $notice)
  <div class="notice__contents">
    <div class="notice__date">{{ substr($notice->created_at, 0, 10) }}</div>
    <div class="notice__txt">{{ $notice->content}}</div>
  </div>
  @endforeach
</div>
<div class="concept" id="concept">
  <div class="concept__inner">
    <div class="concept__content">
      <p class="concept__content-ttl">キタチョクとは？</p>
      <p class="concept__content-txt">北海道の農産物直売所ポータルサイトです。</p>
      <p class="concept__content-txt">北海道には美味しい農産物がたくさんあります。</p>
      <p class="concept__content-txt">直売所にはそんな農産物がたくさん売っています。</p>
      <p class="concept__content-txt">そんな直売所に、ぜひ足を運んでほしいと思い</p>
      <p class="concept__content-txt">このサイトを作成しました。</p>
      <p class="concept__content-txt">ぜひ、全道さまざまな旬を味わいに</p>
      <p class="concept__content-txt">直売所を訪れていただけたら嬉しいです。</p>
    </div>
  </div>
</div>
<div class="howtouse">
  <div class="howtouse__ttl">
    <p class="howtouse__ttl-text">キタチョクでできること</p>
    <div class="howtouse__ttl-block"></div>
  </div>
  <div class="howtouse__content">
    <div class="howtouse__left">
      <div class="howtouse__left-ttl">北海道の直売所を検索！</div>
      <div class="howtouse__left-ttl-block"></div>
      <div class="howtouse__left-text">
        <p>トップ画面から北海道の直売所などを検索できます。</p>
        <p>エリア、キーワード、特徴などから検索できます。</p>
      </div>
    </div>
    <div class="howtouse__right">
      <img src="{{ asset('images/howto_search.png') }}" alt="キタチョク">
    </div>
  </div>
  <div class="howtouse__content">
    <div class="howtouse__left">
      <div class="howtouse__left-ttl">北海道の旬な作物を検索！</div>
      <div class="howtouse__left-ttl-block"></div>
      <div class="howtouse__left-text">
        <p>ユーザーの皆様が作成した「旬カレンダー」を元に、</p>
        <p>今が旬な農産物を検索できます。</p>
        <p>農産物の旬は逃すと来年まで待たなければいけない</p>
        <p>ことが大半です。</p>
        <p>ぜひ検索して、美味しいものの旬を</p>
        <p>逃さずゲットしてください。</p>
      </div>
    </div>
    <div class="howtouse__right">
      <img src="{{ asset('images/howto_calendar-search.png') }}" alt="キタチョク">
    </div>
  </div>
  <div class="howtouse__content">
    <div class="howtouse__left">
      <div class="howtouse__left-ttl">好きな店舗をお気に入り登録！</div>
      <div class="howtouse__left-ttl-block"></div>
      <div class="howtouse__left-text">
        <p>※会員登録・ログインが必要です。</p>
        <p>好きな店舗をお気に入り登録できます</p>
        <p>お気に入り登録した店舗はマイページで確認できます。</p>
      </div>
    </div>
    <div class="howtouse__right">
      <img src="{{ asset('images/howto_fav.png') }}" alt="キタチョク">
    </div>
  </div>
  <div class="howtouse__content">
    <div class="howtouse__left">
      <div class="howtouse__left-ttl">旬カレンダーを作って共有！</div>
      <div class="howtouse__left-ttl-block"></div>
      <div class="howtouse__left-text">
        <p>※会員登録・ログインが必要です。</p>
        <p>販売されている農産物と、販売期間を追加すると</p>
        <p>マイページのカレンダー上に表示されます！</p>
        <p>他のユーザーが作った旬カレンダーをいいねしても</p>
        <p>自分のカレンダーに追加されます。</p>
        <p>お好きな農産物の旬の情報を集めて</p>
        <p>自分だけの「旬カレンダー」をつくりましょう！</p>
      </div>
    </div>
    <div class="howtouse__right">
      <img src="{{ asset('images/howto_favcalendar1.png') }}" alt="キタチョク">
      <p>別のユーザーの旬カレンダーにはいいねボタンが出ます</p>
      <img src="{{ asset('images/howto_favcalendar2.png') }}" alt="キタチョク">
      <p>マイページで自分が登録した旬カレンダーと</p>
      <p>いいねした旬カレンダーが表示されます。</p>
      <p>自分が登録したものに関しては、</p>
      <p>カレンダー自体の「編集」と「削除」ができます。</p>
      <p>いいねした旬カレンダーは</p>
      <p>「いいね」の取り消しだけができます。</p>
    </div>
  </div>
  <div class="howtouse__content">
    <div class="howtouse__left">
      <div class="howtouse__left-ttl">店舗の情報を追加・更新！</div>
      <div class="howtouse__left-ttl-block"></div>
      <div class="howtouse__left-text">
        <p>※会員登録・ログインが必要です。</p>
        <p>みなさんが知っている店舗の情報を追加してください。</p>
        <p>みなさんで情報共有して作っていければと思います。</p>
      </div>
    </div>
    <div class="howtouse__right">
      <img src="{{ asset('images/howto_shopedit1.png') }}" alt="キタチョク">
      <p>上部の「店舗追加」から追加が、</p>
      <p>店舗ページの「情報を追加する」から編集ができます。</p>
      <img src="{{ asset('images/howto_shopedit2.png') }}" alt="キタチョク">
    </div>
  </div>
</div>
@endsection
@section ('add-js')
<script src="{{ asset('js/index.js') }}"></script>
@endsection