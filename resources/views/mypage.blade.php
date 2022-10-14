@extends ('layouts.default')

@section ('content')
<div class="mypage">
  <div class="mypage__username">{{ $user->name }}様ログイン中</div>
  <div class="mypage__top">
    会員の設定確認・変更は<a href="/user/settings">こちら</a>から
  </div>
  <div class="mypage__top-reservation">
    <div class="mypage__ttl-reservation">来店予約クーポン</div>
    <div class="mypage__txt-reservation">予定：{{ $unvisited_reservations->count() }}件</div>
    <div class="mypage__content-error">
      @error('reservation_date')
      {{ $message }}
      @enderror
    </div>
  </div>
  <div class="mypage__reservation-content">
    @foreach($unvisited_reservations as $unvisited_reservation)
    <div class="mypage__reservation-card">
      <form action="/reservation/update/{{ $unvisited_reservation->id }}" method="post" id="reservation_update_{{ $unvisited_reservation->id }}">
        @csrf
        <table class="mypage__reservation-table">
          <tr>
            <td class="mypage__reservation-table-ttl">店名</td>
            <td class="mypage__reservation-table-content">{{ $unvisited_reservation->coupon->shop->name }}</td>
          </tr>
          <tr>
            <td class="mypage__reservation-table-ttl">クーポン名</td>
            <td class="mypage__reservation-table-content">
              <select name="coupon_id" class="mypage__reservation-select">
                @foreach($unvisited_reservation->coupon->shop->coupons as $coupon)
                <option value="{{ $coupon->id }}" {{ $unvisited_reservation->coupon_id == $coupon->id ? 'selected' : ''}}>{{ $coupon->name }}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <td class="mypage__reservation-table-ttl">来店日</td>
            <td class="mypage__reservation-table-content">
              <input type="date" name="reservation_date" id="tomorrow" class="mypage__reservation-date" value="{{ $unvisited_reservation->reservation_date }}">
            </td>
          </tr>
          <tr>
            <td class="mypage__reservation-table-ttl">来店時間</td>
            <td class="mypage__reservation-table-content">
              <select name="reservation_time" class="mypage__reservation-time">
                @for ($i = 8; $i <= 20; $i++) 
                <option value="{{ substr('0'.$i, -2) }}:00:00" {{ $unvisited_reservation->reservation_time == substr('0'.$i, -2).':00:00' ? 'selected' : ''}}>{{ substr('0'.$i, -2) }}:00</option>
                <option value="{{ substr('0'.$i, -2) }}:30:00" {{ $unvisited_reservation->reservation_time == substr('0'.$i, -2).':30:00' ? 'selected' : ''}}>{{ substr('0'.$i, -2) }}:30</option>
                @endfor
              </select>
            </td>
          </tr>
        </table>
      </form>
      <div class="mypage__reservation-bottom">
        <div class="mypage__reservation-btn"><button type="submit" class="mypage__reservation-changebtn" form="reservation_update_{{ $unvisited_reservation->id }}">変更する</button></div>
          <form class="mypage__reservation-btn" action="/reservation/destroy/{{ $unvisited_reservation->id }}" method="post">
            @csrf
            <button type="submit" class="mypage__reservation-deletebtn">削除</button>
          </form>
      </div>
    </div>
    @endforeach
  </div>
  <form action="/search/favorite" method="get" class="mypage__top-fav">
    <div class="mypage__fav-ttl">お気に入り店舗</div>
    <div class="mypage__fav-search-name">
      <input class="mypage__fav-searchbox--name" type="text" name="search_name" placeholder= "{{ !empty($search_name) ? '': '店名で検索' }}" value="{{ !empty($search_name) ? $search_name : '' }}">
    </div>
    <div class="mypage__fav-search-area">
      <select name="search_area" class="mypage__fav-searchbox--area" onchange="changeColor(this)">
        <option value="">エリアを選択</option>
        @foreach ($areas as $area)
        <option value="{{ $area->id }}" {{ !empty($search_area)&&($area->id == $search_area) ? 'selected' : '' }}>{{ $area->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="mypage__fav-search-btn">
      <button type="submit" class="mypage__fav-btn">検索</button>
    </div>
  </form>
  <div class="mypage__fav-content">
    @foreach($favorites as $favorite)
    <div class="mypage__fav-shop">
      <div class="mypage__fav-img">
        @if(app()->isLocal())
        <img src="{{ asset('storage/shopimg/'.$favorite->shop->shop_img) }}" alt="店舗画像">
        @else
        <img src="https://jing-bay-infra-storage.s3.ap-northeast-1.amazonaws.com/{{ $favorite->shop->shop_img }}" alt="店舗画像">
        @endif
      </div>
      <div class="mypage__fav-inner">
        <h1>
          <a href="/detail/{{ $favorite->shop_id }}">{{ $favorite->shop->name }}</a>
        </h1>
        <div class="mypage__fav-shopcontent">
          <div class="mypage__fav-content-left">
            <div>エリア：{{ $favorite->shop->area->name }}</div>
            <div>
              タグ：
              @foreach ($favorite->shop->tags as $tag)
              <span class="result__shop-tag">{{ $tag->name }}</span>
              @endforeach
            </div>
          </div>
          <div>
            @if ($favorite->shop->is_liked_by_auth_user())
            <form action="/favorite/destroy/{{ $favorite->id }}" method="post">
              @csrf
              <input type="image" src="{{ asset('images/fav.jpg') }}" class="result__fav--btn">   
            </form>
            @endif 
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <form class="mypage__top-visited" action="/search/visited" method="get">
    <div class="mypage__visited-ttl">来店履歴</div>
    <div class="mypage__visited-search-na">
      <div class="mypage__visited-search-name">
        <input class="mypage__visited-searchbox--name" type="text" name="search_name2" placeholder= "{{ !empty($search_name2) ? '': '店名で検索' }}" value="{{ !empty($search_name2) ? $search_name2 : '' }}">
      </div>
      <div class="mypage__visited-search-area">
        <select name="search_area2" class="mypage__visited-searchbox--area" onchange="changeColor(this)">
          <option value="">エリアを選択</option>
          @foreach ($areas as $area)
          <option value="{{ $area->id }}" {{ !empty($search_area2)&&($area->id == $search_area2) ? 'selected' : '' }}>{{ $area->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="mypage__visited-search-date">
      <div class="mypage__visited-search-from">
        来店日：<input type="date" name="search_from_date" onchange="changeColor(this)" value="{{ !empty($search_from_date) ? $search_from_date : '' }}">
      </div>
      <div class="mypage__visited-search-to">
        〜<input type="date" name="search_to_date" onchange="changeColor(this)" value="{{ !empty($search_to_date) ? $search_to_date : '' }}">
      </div>
    </div>
    <div class="mypage__visited-search-btn">
      <button type="submit" class="mypage__visited-btn">検索</button>
    </div>
  </form>
  <div class="mypage__visited-content">
  @foreach($visited_reservations as $visited_reservation)
    <div class="mypage__visited-shop">
      <div class="mypage__visited-img">
        @if(app()->isLocal())
        <img src="{{ asset('storage/shopimg/'.$visited_reservation->coupon->shop->shop_img) }}" alt="店舗画像">
        @else
        <img src="https://jing-bay-infra-storage.s3.ap-northeast-1.amazonaws.com/{{ $visited_reservation->coupon->shop->shop_img }}" alt="店舗画像">
        @endif
      </div>
      <div class="mypage__visited-inner">
        <h1>
          <a href="/detail/{{ $visited_reservation->coupon->shop_id }}">
            {{ $visited_reservation->coupon->shop->name }}
          </a>
        </h1>
        <div class="mypage__visited-shopcontent">
          <div class="mypage__visited-content-left">
            <div>来店日：{{ $visited_reservation->reservation_date }}</div>
            <div>
              @if(empty($visited_reservation->evaluation->id))
              <a href="/evaluation/create/{{ $visited_reservation->id }}">レビューを書く</a>
              @else
              <a href="/evaluation/edit/{{ $visited_reservation->evaluation->id }}">レビューを編集する</a>
              @endif
            </div>
          </div>
          <div>
            @if ($visited_reservation->coupon->shop->is_liked_by_auth_user())
            @foreach ($favorites as $favorite)
            @if ($visited_reservation->coupon->shop_id == $favorite->shop_id)
            <form action="/favorite/destroy/{{ $favorite->id }}" method="post">
              @csrf
              <input type="image" src="{{ asset('images/fav.jpg') }}" class="result__fav--btn">
            @endif
            @endforeach
            @else
            <form action="/favorite" method="post">
              @csrf
              <input type="hidden" value="{{ $visited_reservation->coupon->shop_id }}" name="shop_id">
              <input type="image" src="{{ asset('images/unfav.jpg') }}" class="result__fav--btn">
            @endif    
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
    </div>
    <div class="mypage__top-review">
      <div class="mypage__ttl-review">あなたのレビュー</div>
      <div class="mypage__txt-review">{{ $evaluations->count() }}件</div>
    </div>
    <div class="mypage__review-inner">
      @foreach($evaluations as $evaluation)
      <div class="mypage__review-content">
        <div class="mypage__review-left">
          <div class="mypage__review-shopttl">{{ $evaluation->reservation->coupon->shop->name }}</div>
          <div class="mypage__review-star">
            @for ($l = 5; $l >= 1; $l--)
            @if($l == $evaluation->evaluation)
            <input id="star{{ $l }}" type="radio" value="{{ $l }}" checked disabled>
            @else
            <input id="star{{ $l }}" type="radio" value="{{ $l }}" disabled>
            @endif
            <label for="star{{ $l }}">★</label>
            @endfor
          </div>
          <div class="mypage__review-date">来店日：{{ $evaluation->reservation->reservation_date }}</div>
          <div class="mypage__review-date">レビュー日時：{{ $evaluation->updated_at }}</div>
        </div>
        <div class="mypage__review-right">
          <div class="mypage__review-comment">{{ $evaluation->comment }}</div>
          <div class="mypage__review-bottom">
            <button class="mypage__review-update">
              <a href="/evaluation/edit/{{ $evaluation->id }}">編集する</a>
            </button>
            <form class="mypage__review-delete" action="/evaluation/destroy/{{ $evaluation->id }}" method="post">
              @csrf
              <button type="submit">削除する</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
</div>
@endsection
@section ('add-js')
<script src="{{ asset('js/search.js') }}"></script>
@endsection
