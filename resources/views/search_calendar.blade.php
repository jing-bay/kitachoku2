@extends('layouts.default')
@section('content')
<div class="result">
  <form action="/search/calendar" method="get" class="result__search">
    @csrf
    <div class="result__searchtab--keyword">
      <input class="result__searchbox--keyword" type="text" name="search_shop" placeholder= "店名検索" onchange="submit(this.form)" value={{ !empty($search_shop) ? $search_shop : '' }}>
    </div>
    <div class="result__searchtab--keyword">
      <input class="result__searchbox--keyword" type="text" name="search_item" onchange="submit(this.form)" placeholder= "商品名で検索" value={{ !empty($search_item) ? $search_item : '' }}>
    </div>
    <div class="result__searchtab--area">
      <select name="search_date" class="result__searchbox--area" onchange="submit(this.form)" onchange="changeColor(this)">
        <option value="">時期を選択</option>
        @for($i = 1; $i <= 12; $i++)
        <option value="{{ $i*3-2 }}" {{ $search_date == ($i*3-2) ? 'selected' : '' }}>{{ $i }}月上旬</option>
        <option value="{{ $i*3-1 }}" {{ $search_date == ($i*3-1) ? 'selected' : '' }}>{{ $i }}月中旬</option>
        <option value="{{ $i*3 }}" {{ $search_date == ($i*3) ? 'selected' : '' }}>{{ $i }}月下旬</option>
        @endfor
      </select>
    </div>
    <div class="result__search-btn">
      <button type="submit" class="result__btn">検索</button>
    </div>
  </form>
  <div class="result__txt">
    <div class="result__txt-line">店名：{{ !empty($search_shop) ? $search_shop : '' }}</div>
    <div class="result__txt-line">商品名：{{ !empty($search_item) ? $search_item : '' }}</div>
    <div class="result__txt-line">時期：
      @if(empty($search_date))
      {{ '' }}
      @elseif(($search_date) % 3 == 1)
      {{ ceil(($search_date)/3) }}月上旬
      @elseif(($search_date) % 3 == 2)
      {{ ceil(($search_date)/3) }}月中旬
      @else
      {{ ceil(($search_date)/3) }}月下旬
      @endif
    </div>
  </div>
  <div class="detail__calendar-inner">
      @foreach($calendars as $calendar)
      <div class="detail__calendar-content">
        <div class="detail__calendar-left">
          <div class="detail__calendar-shopttl"><a href="/detail/{{ $calendar->shop_id }}">店名：{{ $calendar->shop->name }}</a></div>
          <div class="detail__calendar-shopheader">
            <div class="detail__calendar-shopttl">{{ $calendar->name }}</div>
            <div>
              @if ($calendar->user_id !== $id)
              @if ($calendar->is_liked_calendar_by_auth_user())
              @foreach ($fav_calendars as $fav_calendar)
              @if ($fav_calendar->calendar_id == $calendar->id)
              <form action="/fav_calendar/destroy/{{ $fav_calendar->id }}" method="post">
                @csrf
                <input type="image" src="{{ asset('images/fav.jpg') }}" class="calendar__fav--btn">
              @endif
              @endforeach
              @else
              <form action="/fav_calendar" method="post">
                @csrf
                <input type="hidden" value="{{ $calendar->id }}" name="calendar_id">
                <input type="image" src="{{ asset('images/unfav.jpg') }}" class="calendar__fav--btn">
                @endif
              </form>
              @endif
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
          <div class="detail__calendar-date"><a href="/search/calendar/{{ $calendar->user_id }}">ユーザー名：{{ $calendar->user->name }}</a></div>
          <div class="detail__calendar-date">追加日時：{{ $calendar->updated_at }}</div>
        </div>
        <div class="detail__calendar-right">
          <div class="detail__calendar-comment">{{ $calendar->comment }}</div>
        </div>
      </div>
      @endforeach
    </div>
  {{ $calendars->links('vendor.pagination.default') }}
  <p class="result__paginate-txt">{{ $calendars->total() }}件中{{ $calendars->firstItem() }}〜{{ $calendars->lastItem() }} 件を表示</p>
</div>
@endsection
@section ('add-js')
<script src="{{ asset('js/search.js') }}"></script>
@endsection