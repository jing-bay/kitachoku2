<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NoticeRequest;

class NoticeController extends Controller
{
    public function store(NoticeRequest $request)
    {
        $form = $request->all();
        Notice::create($form);
        
        return back();
    }

    public function destroy($notice_id)
    {
        Notice::find($notice_id)->delete();

        return back();
    }
}
