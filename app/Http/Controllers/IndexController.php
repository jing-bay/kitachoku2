<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Area;
use App\Models\Notice;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $areas = Area::all();
        $notices = Notice::latest()->take(3)->get();

        return view('index', compact('tags', 'areas', 'notices'));
    }
}
