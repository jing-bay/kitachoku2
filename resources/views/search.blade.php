@extends('layouts.default')
@section('content')

<div class="result">
  <form action="/search" method="get" class="result__search">
    @csrf
    <div class="result__searchtab--tag">
      <div class="result__tag-first" id="tagList">
        タグを選択
      </div>
      <ul class="result__tag-list" id="resultTag">
      @foreach ($tags as $tag)
        <li class="result__tag">
          <input type="checkbox" class="result__searchbox--tag" name="search_tag[]" value="{{ $tag->id }}" id="{{ $tag->name }}" {{ is_array($search_tag)&&in_array($tag->id, $search_tag) ? 'checked' : '' }}>
          <label for="{{ $tag->name }}" class="result__tag-label">{{ $tag->name }}</label>
        </li>
      @endforeach
      </ul>
    </div>
    <div class="result__searchtab--area">
      <select name="search_area" class="result__searchbox--area" onchange="changeColor(this)">
        <option value="">エリアを選択</option>
        @foreach ($areas as $area)
        <option value="{{ $area->id }}" {{ !empty($search_area)&&($area->id == $search_area) ? 'selected' : ''}}>{{ $area->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="result__searchtab--keyword">
      <input class="result__searchbox--keyword" type="text" name="search_keyword" placeholder= "{{ !empty($search_keyword) ? $search_keyword : '店名・住所で検索' }}">
    </div>
    <div class="result__search-btn">
      <button type="submit" class="result__btn">検索</button>
    </div>
  </form>
  <div class="result__txt">
    <div class="result__txt-line">エリア： {{ !empty($search_area) ? $s_a->name : '' }}</div>
    <div class="result__txt-line">
      タグ：@if (is_array($search_tag))
      @foreach ($search_t as $s_t)
      {{ $s_t->name }}
      @endforeach
      @else
      @endif
    </div>
    <div class="result__txt-line">キーワード： {{ !empty($search_keyword) ? $search_keyword : '' }}</div>
  </div>
  <div class="result__main">
    @foreach ($shops as $shop)
    <div class="result__shop">
      <div class="result__shop-img">
        <img src="{{ asset('storage/shopimg/'.$shop->shop_img) }}" alt="店舗画像">
      </div>
      <div class="result__shop-inner">
        <h1 class="result__shop-ttl">
          <a href="/detail/{{ $shop->id }}">{{ $shop->name }}</a>
        </h1>
        <div class="result__shop-content">
          <div class="result__content-left">
            <div>エリア：{{ $shop->area->name }}</div>
            タグ：
            @foreach ($shop->tags as $tag)
            <span>{{ $tag->name }}</span>
            @endforeach
          </div>
          <div>
            @if ($shop->is_liked_by_auth_user())
            @foreach ($favorites as $favorite)
            @if ($favorite->shop_id == $shop->id)
            <form action="/favorite/destroy/{{ $favorite->id }}" method="post">
              @csrf
              <input type="image" src="{{ asset('images/fav.jpg') }}" class="result__fav--btn">
            @endif
            @endforeach
            @else
            <form action="/favorite" method="post">
              @csrf
              <input type="hidden" value="{{ $shop->id }}" name="shop_id">
              <input type="image" src="{{ asset('images/unfav.jpg') }}" class="result__fav--btn">
            @endif    
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  {{ $shops->links('vendor.pagination.default') }}
  <p class="result__paginate-txt">{{ $shops->total() }}件中{{ $shops->firstItem() }}〜{{ $shops->lastItem() }} 件を表示</p>
</div>
@endsection
@section ('add-js')
<script src="{{ asset('js/search.js') }}"></script>
@endsection