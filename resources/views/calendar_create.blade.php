@extends ('layouts.default')
@section ('content')
<div class="register">
  <p class="register__ttl">旬カレンダー</p>
  <div class="register__content">
    <form action="/calendar" method="post" id="calendar">
      <table class="register__inner">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <tr>
          <td class="register__content-ttl">店舗名</td>
          <td class="register__content-item">
            {{ $shop->name }}
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">商品名</td>
          <td class="register__content-item">
            @error('name')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="name">
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">時期</td>
          <td class="register__content-item">
            @error('start_date')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            @error('end_date')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <select name="start_date">
              @for($i = 1; $i <= 12; $i++)
              <option value="{{ $i*3-2 }}">{{ $i }}月上旬</option>
              <option value="{{ $i*3-1 }}">{{ $i }}月中旬</option>
              <option value="{{ $i*3 }}">{{ $i }}月下旬</option>
              @endfor
            </select>
            ~
            <select name="end_date">
              @for($j = 1; $j <= 12; $j++)
              <option value="{{ $j*3-2 }}">{{ $j }}月上旬</option>
              <option value="{{ $j*3-1 }}">{{ $j }}月中旬</option>
              <option value="{{ $j*3 }}">{{ $j }}月下旬</option>
              @endfor
            </select>
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl calendar__comment-ttl">コメント</td>
          @error('comment')
          <p class="register__content-error">{{ $message }}</p>
          @enderror
          <td><textarea name="comment" class="register__content-comment"></textarea></td>
        </tr>
      </table>
    </form>
  </div>
  <div class="shopedit__admin-bottom">
    <button type="submit" class="shopedit__admin-changebtn" form="calendar">追加する</button>
  </div>
</div>
@endsection