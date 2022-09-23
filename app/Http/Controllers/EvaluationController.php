<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\EvaluationRequest;

class EvaluationController extends Controller
{
    public function create($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        $user = Auth::user();

        return view('evaluation', compact('user', 'reservation'));
    }

    public function store(EvaluationRequest $request)
    {
        Evaluation::create([
            'reservation_id' => $request->reservation,
            'evaluation' => $request->evaluation,
            'comment' => $request->comment,
        ]);

        return redirect('/mypage');
    }

    public function edit($evaluation_id)
    {
        $evaluation = Evaluation::find($evaluation_id);
        $user = Auth::user();

        return view('evaluation', compact('user', 'evaluation'));
    }

    public function update($evaluation_id, EvaluationRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Evaluation::find($evaluation_id)->update($form);

        return redirect('/mypage');
    }

    public function destroy($evaluation_id)
    {
        Evaluation::find($evaluation_id)->delete();

        return redirect('/mypage');
    }
}
