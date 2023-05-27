@extends ('layouts.default')
@section ('content')
<div class="mypage">
  <div class="mypage__username">{{ $user->name }}様ログイン中</div>
  <div class="mypage__top">
    <p class="mypage__ttl">設定変更</p>
    <div class="register__content">
      <table class="register__inner">
        <form action="/user/update" method="post" id="update_{{ $user->id }}">
          @csrf
          <tr>
            <td class="register__content-ttl">名前</td>
            <td class="register__content-item">
              @error('name')
              <p class="register__content-error">{{ $message }}</p>
              @enderror
              <input type="text" name="name" value="{{ $user->name }}">
            </td>
          </tr>
          <tr>
            <td class="register__content-ttl">ニックネーム</td>
            <td class="register__content-item">
              @error('nickname')
              <p class="register__content-error">{{ $message }}</p>
              @enderror
              <input type="text" name="nickname" value="{{ $user->nickname }}">
            </td>
          </tr>
          <tr>
            <td class="register__content-ttl">メールアドレス</td>
            <td class="register__content-item">
              @error('email')
              <p class="register__content-error">{{ $message }}</p>
              @enderror
              <input type="text" name="email" value="{{ $user->email }}">
            </td>
          </tr>
        </form>
      </table>
    </div>
    <div class="mypage__bottom">
      <div class="mypage__btn">
        <button type="submit" form="update_{{ $user->id }}" class="mypage__update">変更する</button>
      </div>
      <form action="/user/destroy" method="post" class="mypage__btn">
        @csrf
        <button type="submit" class="mypage__delete">退会する</button>
      </form>
    </div>
  </div>
  <form action="/search/favorite" method="get" class="mypage__top-fav">
    <div class="mypage__ttl">お気に入り店舗</div>
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
        @if(empty($favorite->shop->shop_img))
        <img src="{{ asset('images/kitachokulogo.001-removebg-preview.jpg') }}" alt="店舗画像">
        @else
        <img src="{{ asset('storage/shopimg/'.$favorite->shop->shop_img_rename) }}" alt="店舗画像">
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
  <div class="mypage__ttl mypage__top-fav">旬カレンダー</div>
  <p class="mypage__calendar__text">いいねしたカレンダーとご自分が追加したカレンダーが表示されます</p>
  <div>
    <div class="calendar__content">
      <div class="calendar__inner">
        <table class="calendar__table">
          <tr>
            <td class="mypage__calendar-editcell"></td>
            <td class="mypage__calendar-editcell"></td>
            <td class="calendar__headcell"></td>
            @for($i = 1; $i <= 12; $i++)
            <td class="calendar__cell" colspan="3">{{ $i }}月</td>
            @endfor
          </tr>
          <tr>
            <td class="mypage__calendar-editcell">編集</td>
            <td class="mypage__calendar-editcell">削除</td>
            <td class="calendar__headcell">店名/商品名</td>
            @for($j = 1; $j <= 12; $j++)
            @foreach($seasons as $season)
            <td class="calendar__cell">{{ $season }}</td>
            @endforeach
            @endfor
          </tr>
          @foreach($fav_calendars as $fav_calendar)
          <tr>
            <td class="mypage__calendar-editcell">
              @if ($fav_calendar->calendar->user_id == $id)
              <a href="/calendar/update/{{ $fav_calendar->calendar->id }}"><input type="image" src="{{ asset('images/edit.jpg') }}" alt="編集" class="mypage__calendar-edit--btn"></a>
              @else
              @endif
            </td>
            <td class="mypage__calendar-editcell">
              @if ($fav_calendar->calendar->user_id == $id)
              <form method="POST" action="/calendar/destroy/{{ $fav_calendar->calendar->id }}">
                @csrf
                <input type="image" src="{{ asset('images/delete.jpg') }}" alt="編集" class="mypage__calendar-edit--btn">
              @else
              <form method="POST" action="/fav_calendar/destroy/{{ $fav_calendar->id }}">
                @csrf
                <input type="image" src="{{ asset('images/fav.jpg') }}" alt="編集" class="mypage__calendar-fav--btn">
              @endif
              </form>
            </td>
            <td class="calendar__headcell">{{ $fav_calendar->calendar->shop->name }}/{{ $fav_calendar->calendar->name }}</td>
            @for($k = 1; $k <= 36; $k++)
            @if($fav_calendar->calendar->start_date <= $k && $fav_calendar->calendar->end_date >= $k && $loop->iteration % 2 == 1)
            <td class="calendar__cell calendar__colored"></td>
            @elseif($fav_calendar->calendar->start_date <= $k && $fav_calendar->calendar->end_date >= $k && $loop->iteration % 2 == 0)
            <td class="calendar__cell calendar__colored2"></td>
            @else
            <td class="calendar__cell"></td>
            @endif
            @endfor
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section ('add-js')
<script src="{{ asset('js/search.js') }}"></script>
@endsection
