<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::get();
        return view('front.home', compact('services'));
    }
}
