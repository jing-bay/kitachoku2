@extends ('layouts.default')
@section ('content')
<div class="detail">
  <p class="detail__back-btn">
    <a href="/search">&lt;検索画面に戻る</a>
  </p>
  <div class="detail__top">
    <h1 class="detail__shop-name">{{ $shop->name }}</h1>
    <div>
      @if ($shop->is_liked_by_auth_user())
      @foreach ($favorites as $favorite)
      @if ($favorite->shop_id == $shop->id)
      <form action="/favorite/destroy/{{ $favorite->id }}" method="post">
        @csrf
        <input type="image" src="{{ asset('images/fav.jpg') }}" class="detail__fav--btn">
      @endif
      @endforeach
      @else
      <form action="/favorite" method="post">
        @csrf
        <input type="hidden" value="{{ $shop->id }}" name="shop_id">
        <input type="image" src="{{ asset('images/unfav.jpg') }}" class="detail__fav--btn">
        @endif
      </form>
    </div>
  </div>
  <div class="detail__shop-top">
    <div class="detail__shop-img">
      @if(empty($shop->shop_img))
      @if(app()->isLocal())
      <img src="{{ asset('storage/shopimg/kitachokulogo.001-removebg-preview.jpg') }}" alt="店舗画像">
      @else
      <img src="https://kitachoku2.s3.ap-northeast-1.amazonaws.com/shopimg/kitachokulogo.001-removebg-preview.jpg" alt="店舗画像">
      @endif
      @else
      @if(app()->isLocal())
      <img src="{{ asset('storage/shopimg/'.$shop->shop_img_rename) }}" alt="店舗画像">
      @else
      <img src="https://kitachoku2.s3.ap-northeast-1.amazonaws.com/{{ $shop->shop_img_rename }}" alt="店舗画像">
      @endif
      @endif
    </div>
    <div class="detail__shop-txt">
      <p class="detail__address">
        {{ $shop->address }}
      </p>
      <div class="detail__map">
        <iframe src="http://maps.google.co.jp/maps?q={{ $shop->address }}&z=15&output=embed&iwloc=J&t=m"></iframe>
      </div>
    </div>
  </div>
  <div class="detail__shop-info">
    <ul class="detail__shop-table">
      <li class="detail__shop-item">エリア：{{ $shop->area->name }}</li>
      <li class="detail__shop-item">電話番号：{{ $shop->tel_number }}</li>
      <li class="detail__shop-item">定休日：{{ $shop->holiday }}</li>
      <li class="detail__shop-item">メールアドレス：{{ $shop->email }}</li>
      <li class="detail__shop-item">営業時間：{{ $shop->opening_hour }}</li>
      <li class="detail__shop-item">店舗URL：{{ $shop->shop_url }}</li>
      <li class="detail__shop-item">FacebookURL：{{ $shop->facebook_url }}</li>
      <li class="detail__shop-item">TwitterURL：{{ $shop->twitter_url }}</li>
    </ul>
  </div>
  <p class="detail__shop-edit">
    <a href="/shop/edit/{{ $shop->id }}">店舗情報を変更する</a>
  </p>
  <div class="detail__top-calendar">
    <div class="detail__ttl-calendar">みんなの旬カレンダー</div>
    <div class="detail__txt-calendar"><a href="/calendar/{{ $shop->id }}">&plus;追加する</a></div>
  </div>
  <div class="detail__calendar-inner">
    @foreach($calendars as $calendar)
    <div class="detail__calendar-content">
      <div class="detail__calendar-left">
        <div class="detail__calendar-shopheader">
          <div class="detail__calendar-shopttl">{{ $calendar->name }}</div>
          <div>
            @if ($calendar->is_liked_calendar_by_auth_user())
            @foreach ($fav_calendars as $fav_calendar)
            @if ($fav_calendar->calendar_id == $calendar->id)
            <form action="/fav_calendar/destroy/{{ $fav_calendar->id }}" method="post">
              @csrf
              <input type="image" src="{{ asset('images/fav.jpg') }}" class="detail__fav--btn">
            @endif
            @endforeach
            @else
            <form action="/fav_calendar" method="post">
              @csrf
              <input type="hidden" value="{{ $calendar->id }}" name="calendar_id">
              <input type="image" src="{{ asset('images/unfav.jpg') }}" class="detail__fav--btn">
              @endif
            </form>
          </div>
        </div>
        <div class="detail__calendar-date">
          時期：
          @if(($calendar->start_date) % 3 == 1)
          {{ ceil(($calendar->start_date)/3) }}月上旬
          @elseif(($calendar->start_date) % 3 == 2)
          {{ ceil(($calendar->start_date)/3) }}月中旬
          @else
          {{ ceil(($calendar->start_date)/3) }}月下旬
          @endif
          〜
          @if(($calendar->end_date) % 3 == 1)
          {{ ceil(($calendar->end_date)/3) }}月上旬
          @elseif(($calendar->end_date) % 3 == 2)
          {{ ceil(($calendar->end_date)/3) }}月中旬
          @else
          {{ ceil(($calendar->end_date)/3) }}月下旬
          @endif
        </div>
        <div class="detail__calendar-date"><a href="/search/calendar/{{ $calendar->user_id }}">ユーザー名：{{ $calendar->user->nickname }}</a></div>
        <div class="detail__calendar-date">追加日時：{{ $calendar->updated_at }}</div>
      </div>
      <div class="detail__calendar-right">
        <div class="detail__calendar-comment">{{ $calendar->comment }}</div>
      </div>
    </div>     
    @endforeach
  </div>
</div>
@endsection