<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Requests\CalendarRequest;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
  public function create($shop_id)
  {
    $shop = Shop::find($shop_id);
    return view('calendar_create', compact('shop'));
  }

  public function store(CalendarRequest $request)
  {
    Calendar::create([
      'user_id' => Auth::id(),
      'shop_id' => $request->shop_id,
      'name' => $request->name,
      'start_date' => $request->start_date,
      'end_date' => $request->end_date,
      'comment' => $request->comment
    ]);

    return redirect(route('detail.show', [
      'shop_id' => $request->shop_id
    ]));
  }

  public function edit($calendar_id)
  {
    $calendar = Calendar::find($calendar_id);

    return view('calendar_edit', compact('calendar'));
  }

  public function update($calendar_id, CalendarRequest $request)
  {
    $form = $request->all();
    $calendar = Calendar::find($calendar_id);

    $calendar->update([
      'user_id' => Auth::id(),
      'shop_id' => $request->shop_id,
      'name' => $request->name,
      'start_date' => $request->start_date,
      'end_date' => $request->end_date,
      'comment' => $request->comment
    ]);

    return redirect('/mypage');
  }

    public function destroy($calendar_id)
  {
    Calendar::find($calendar_id)->delete();

    return redirect('/mypage');
  }
}