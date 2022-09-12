@extends ('layouts.default')

@section ('content')
<div class="detail">
  <div class="detail__back-btn">
  </div>
  <div class="detail__top">
    <div class="detail__shop-name"></div>
    <div class="detail__fav--btn"></div>
  </div>
  <div class="detail__shop-img">

  </div>
  <table class="detail__shop-table">

  </table>
  <div class="detail__map">

  </div>
  <div class="detail__middle">
    <div class="detail__sns">
      <div class="detail__sns-ttl"></div>
      <div class="detail__sns-content">
        <div class="detail__facebook"></div>
        <div class="detail__twitter"></div>
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
  <div class="detail__review">
    <div class="detail__review-top">
      <div class="detail__review-ttl"></div>
      <div class="detail__review-top-txt"></div>
    </div>
    <div class="detail__review-content">
      <div class="detail__review-inner">
        <div class="detail__inner-left">
          <p class="detail__review-user"></p>
          <p class="detail__review-ster"></p>
          <p class="detail__visited-date"></p>
          <p class="detail__review-date"></p>
        </div>
        <div class="detail__inner-right"></div>
      </div>
    </div>
  </div>
</div>
@endsection