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
      <p class="concept__content-txt">キタチョクとは、北海道の農産物直売所ポータルサイトです。</p>
      <p class="concept__content-txt">北海道にはとても美味しい農産物がたくさんあります。</p>
      <p class="concept__content-txt">直売所には、そんな現地でしか食べられない農産物がたくさん売っています。</p>
      <p class="concept__content-txt">中には農家さんが直営しているような、知られていないけれど
      <p class="concept__content-txt">とても美味しい農産物が売っている小規模な直売所もあります。</p>
      <p class="concept__content-txt">そんな直売所に、ぜひ足を運んでほしいという思いでこのサイトを作成しました。</p>
      <p class="concept__content-txt">ぜひ、全道さまざまな旬を味わいに直売所を訪れていただけたら嬉しいです。</p>
    </div>
  </div>
</div>
@endsection
@section ('add-js')
<script src="{{ asset('js/index.js') }}"></script>
@endsection
