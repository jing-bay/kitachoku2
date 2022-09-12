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
        <input type="image" src="{{ asset('images/fav.jpg') }}" class="detail__fav--btn">
      @endif
      @endforeach
      @else
      <form action="/favorite" method="post">
        <input type="hidden" value="{{ $shop->id }}" name="shop_id">
        <input type="image" src="{{ asset('images/unfav.jpg') }}" class="detail__fav--btn">
      @endif    
      @csrf
      </form>
    </div>
  </div>
  <div class="detail__shop-info">
    <div class="detail__shop-img">
      <img src="{{ asset('images/4829554_s.jpg') }}" alt="店舗画像">
    </div>
    <div class="detail__shop-txt">
      {{ $shop->overview }}
    </div>
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
    <p class="detail__address">
      住所：{{ $shop->address }}
    </p>
    <div class="detail__map">
      <iframe src="http://maps.google.co.jp/maps?q={{ $shop->address }}&z=15&output=embed&iwloc=J&t=m"></iframe>
    </div>
  </div>
  <div class="detail__middle">
    <div class="detail__review">
      <div class="detail__review-top">
        <div class="detail__review-ttl">レビュー</div>
        <div class="detail__review-top-txt">{{ $evaluations->count() }}件</div>
      </div>
      <div class="detail__review-content">
        @foreach($evaluations as $evaluation)
        <div class="detail__review-item">
          <div class="detail__review-left">
            <p class="detail__review-user">{{ $evaluation->user->name }}</p>
            <p class="detail__review-star">{{ $evaluation->evaluation }}</p>
            <p class="detail__visited-date">{{ $evaluation->user->name }}</p>
            <p class="detail__review-date"></p>
          </div>
          @endforeach
          <div class="detail__review-right">
        </div>
      </div>
    </div>
    <div class="detail__coupon">
      <div class="detail__coupon-ttl"></div>
      <div class="detail__coupon-content">
        <table class="detail__coupon-table">
        </table>
        <div class="detail__reservation-btn">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection