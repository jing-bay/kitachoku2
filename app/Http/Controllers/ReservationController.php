<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $form = $request->all();
        Reservation::create($form);

        return redirect('/resavation-thanks');
    }

    public function show()
    {
        return view('reservation_thanks');
    }

    public function update($reservation_id, ReservationRequest $request)
    {
        $form = $request->all();
        Reservation::find($reservation_id)->update($form);

        return redirect('/resavation-thanks');
    }

    public function destroy($reservation_id)
    {
        Reservation::find($reservation_id)->delete($form);

        return redirect('/reservation-cancel');
    }

    public function cancel()
    {
        return view('reservation_cancel');
    }
}
