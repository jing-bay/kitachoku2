@extends ('layouts.default')
@section ('content')
<div class="register">
  <p class="register__ttl">旬カレンダー</p>
  <div class="register__content">
    <form action="/calendar/update/{{ $calendar->id }}" method="post" id="calendar_edit">
      <table class="register__inner">
          @csrf
          <input type="hidden" name="shop_id" value="{{ $calendar->shop_id }}">
          <tr>
            <td class="register__content-ttl">店舗名</td>
            <td class="register__content-item">
              {{ $calendar->shop->name }}
            </td>
          </tr>
          <tr>
            <td class="register__content-ttl">商品名</td>
            <td class="register__content-item">
              @error('name')
              <p class="register__content-error">{{ $message }}</p>
              @enderror
              <input type="text" name="name" value="{{ $calendar->name }}">
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
                <option value="{{ $i*3-2 }}" {{ $calendar->start_date == ($i*3-2) ? 'selected' : '' }}>{{ $i }}月上旬</option>
                <option value="{{ $i*3-1 }}"{{ $calendar->start_date == ($i*3-1) ? 'selected' : '' }}>{{ $i }}月中旬</option>
                <option value="{{ $i*3 }}" {{ $calendar->start_date == ($i*3) ? 'selected' : '' }}>{{ $i }}月下旬</option>
                @endfor
              </select>
              ~
              <select name="end_date">
                @for($j = 1; $j <= 12; $j++)
                <option value="{{ $j*3-2 }}" {{ $calendar->end_date == ($j*3-2) ? 'selected' : '' }}>{{ $j }}月上旬</option>
                <option value="{{ $j*3-1 }}" {{ $calendar->end_date == ($j*3-1) ? 'selected' : '' }}>{{ $j }}月中旬</option>
                <option value="{{ $j*3 }}" {{ $calendar->end_date == ($j*3) ? 'selected' : '' }}>{{ $j }}月下旬</option>
                @endfor
              </select>
            </td>
          </tr>
          <tr>
            <td class="calendar__comment-ttl">コメント</td>
            @error('comment')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <td><textarea name="comment" class="register__content-comment">{{ $calendar->comment }}</textarea></td>
          </tr>
      </table>
    </form>
  </div>
  <div class="shopedit__admin-bottom">
    <button class="shopedit__admin-changebtn" form="calendar_edit">変更する</button>
  </div>
</div>
@endsection