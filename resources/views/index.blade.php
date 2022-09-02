@extends ('layouts.default')

@section ('content')
<form action="/search" method="get">
  @foreach($tags as $tag)
  <input type="checkbox" name="search_tag[]" value="{{ $tag->id }}">{{ $tag->name }}
  @endforeach

  <select name="search_area">
    @foreach($areas as $area)
    <option value="{{ $area->id }}">{{ $area->name }}</option>
    @endforeach
  </select>

  <input type="text" name="search_keyword">

  <button type="submit">検索</button>
</form>

@endsection