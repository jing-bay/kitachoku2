<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        Reservation::create([
            'user_id' => Auth::id(),
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'coupon_id' => $request->coupon_id,
        ]);

        return redirect('/reservation-thanks');
    }

    public function show()
    {
        return view('reservation_thanks');
    }

    public function update($reservation_id, ReservationRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Reservation::find($reservation_id)->update($form);

        return redirect('/reservation-thanks');
    }

    public function destroy($reservation_id)
    {
        Reservation::find($reservation_id)->delete();

        return redirect('/reservation-cancel');
    }

    public function cancel()
    {
        return view('reservation_cancel');
    }
}
