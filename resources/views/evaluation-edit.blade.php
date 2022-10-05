@extends ('layouts.default')
@section ('content')
<div class="evaluation">
  <p class="evaluation__ttl">レビュー</p>
  <form action="/evaluation/update/{{ $evaluation->id }}" method="post">
    @csrf
    <div class="evaluation__content">
      <table class="evaluation__inner">
        <tr>
          <td class="evaluation__content-ttl">店名</td>
          <td class="evaluation__content-item">{{ $evaluation->reservation->coupon->shop->name }}</td>
        </tr>
        <tr>
          <td class="evaluation__content-ttl">来店日</td>
          <td class="evaluation__content-item">{{ $evaluation->reservation->reservation_date }}</td>
        </tr>
        <tr>
          <td class="evaluation__content-ttl">評価</td>
          <td class="evaluation__content-item">
            @error('evaluation')
            <p class="evaluation__content-error">{{ $message }}</p>
            @enderror
            <div class="rate-form">
              @for ($l = 5; $l >= 1; $l--)
              <input id="star{{ $l }}" type="radio" name="evaluation" value="{{ $l }}" {{ $evaluation->evaluation == $l ? 'checked' : '' }}>
              <label for="star{{ $l }}">★</label>
              @endfor
            </div>
          </td>
        </tr>
        <tr>
          <td class="evaluation__content-ttl">コメント</td>
          <td class="evaluation__content-item">
            @error('comment')
            <p class="evaluation__content-error">{{ $message }}</p>
            @enderror
            <textarea name="comment" class="evaluation__content-form">{{ $evaluation->comment }}</textarea>
          </td>
        </tr>
      </table>
    </div>
    <div class="evaluation__btn">
      <input type="hidden" value="{{ $evaluation->reservation->id }}" name="reservation_id">
      <button class="evaluation__btn-form" type="submit">更新する</button>
    </div>
  </form>
</div>
@endsection