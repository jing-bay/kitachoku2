@extends ('layouts.default')
@section ('content')
<div class="calendar">
  <div class="calendar__ttl">
    {{ $user->nickname }}さんの旬カレンダー
  </div>
  <div class="calendar__content">
    <div class="calendar__inner">
      <table class="calendar__table">
        <tr>
          <td class="calendar__headcell"></td>
          @for($i = 1; $i <= 12; $i++)
          <td class="calendar__cell" colspan="3">{{ $i }}月</td>
          @endfor
        </tr>
        <tr>
          <td class="calendar__headcell">店名/商品名</td>
          @for($j = 1; $j <= 12; $j++)
          @foreach($seasons as $season)
          <td class="calendar__cell">{{ $season }}</td>
          @endforeach
          @endfor
        </tr>
        @foreach($calendars as $calendar)
        <tr>
          <td class="calendar__headcell">{{ $calendar->shop->name }}/{{ $calendar->name }}</td>
          @for($k = 1; $k <= 36; $k++)
          @if($calendar->start_date <= $k && $calendar->end_date >= $k && $loop->iteration % 2 == 1)
          <td class="calendar__cell calendar__colored"></td>
          @elseif($calendar->start_date <= $k && $calendar->end_date >= $k && $loop->iteration % 2 == 0)
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
@endsection