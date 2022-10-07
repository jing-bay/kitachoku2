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
      @if(app()->isLocal())
      <img src="{{ asset('storage/shopimg/'.$shop->shop_img) }}" alt="店舗画像">
      @else
      <img src="{{ $shop->shop_img }}" alt="店舗画像">
      @endif
    </div>
    <div class="detail__shop-txt">
      {{ $shop->overview }}
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
          <p class="detail__review-user">{{ $evaluation->reservation->user->nickname }}様</p>
          <p class="detail__visited-date">来店日：{{ $evaluation->reservation->reservation_date }}</p>
          <p class="detail__review-star">
            @for ($l = 5; $l >= 1; $l--)
            @if($l == $evaluation->evaluation)
            <input id="star{{ $l }}" type="radio" name="evaluation" value="{{ $l }}" checked disabled>
            @else
            <input id="star{{ $l }}" type="radio" name="evaluation" value="{{ $l }}" disabled>
            @endif
            <label for="star{{ $l }}">★</label>
            @endfor
          </p>
          <div class="detail__review-comment">{{ $evaluation->comment }}</div>
          <p class="detail__review-date">{{ $evaluation->created_at }}</p>
        </div>
        @endforeach
      </div>
    </div>
    <div class="detail__coupon">
      <div class="detail__coupon-ttl">来店予約クーポン</div>
      <form class="detail__coupon-content" method="post" action="/reservation">
        @csrf
        <table class="detail__coupon-table">
          <tr>
            <td class="detail__table-ttl">クーポン名</td>
            <td>
              <div class="detail__reservation-error">
                @error('coupon_id')
                {{ $message }}
                @enderror
              </div>
              <select name="coupon_id" class="detail__coupon-select">
                @foreach($coupons as $coupon)
                <option value="{{ $coupon->id }}">{{ $coupon->name }}</option>
                @endforeach
              </select>
            </td>
          </tr>
          <tr>
            <td class="detail__table-ttl">来店日</td>
            <td class="detail__reservation-date">
              <div class="detail__reservation-error">
                @error('reservation_date')
                {{ $message }}
                @enderror
              </div>
              <input type="date" name="reservation_date" id="tomorrow">
            </td>
          </tr>
          <tr>
            <td class="detail__table-ttl">来店時間</td>
            <td>
              <div class="detail__reservation-error">
                @error('reservation_time')
                {{ $message }}
                @enderror
              </div>
              <select name="reservation_time" class="detail__reservation-time">
                @for ($i = 8; $i <= 20; $i++) 
                <option value="{{ substr('0'.$i, -2) }}:00:00">{{ substr('0'.$i, -2) }}:00</option>
                <option value="{{ substr('0'.$i, -2) }}:30:00">{{ substr('0'.$i, -2) }}:30</option>
                @endfor
              </select>
            </td>
          </tr>
        </table>
        <div class="detail__reservation-btn">
          <button type="submit" class="detail__btn">予約</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section ('add-js')
<script src="{{ asset('js/reservation.js') }}"></script>
@endsection