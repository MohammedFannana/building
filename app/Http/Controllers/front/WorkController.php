<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function index()
    {
        $work = Work::first();
        return view('front.works.index', compact('work'));
    }
}
