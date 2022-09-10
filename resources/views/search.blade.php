@extends('layouts.default')
@section('content')

<div class="result">
  <div class="result__inner">
    <form action="/search" method="get" class="result__search">
      <select name="search_area">
        @foreach($areas as $area)
        <option value="{{ $area->id }}">{{ $area->name }}</option>
        @endforeach
      </select>
        @foreach($tags as $tag)
        <input type="checkbox" name="search_tag[]" value="{{ $tag->id }}">{{ $tag->name }}
        @endforeach

        <input type="text" name="search_keyword">

        <button type="submit">検索</button>
      </form>
    </div>

  @foreach($shops as $shop)
  {{ $shop->name }}
  @endforeach

  {{ $shops->links() }}
  </div>
</div>

@endsection