<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index()
    {
        return City::all();
    }
    public function getCareer()
    {
        return DB::table('careers')->get();
    }
}
