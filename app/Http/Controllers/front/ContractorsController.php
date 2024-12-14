<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ContractorsController extends Controller
{
    public function index(Request $request)
    {
        $contractores = User::where('user_type', 'provider')->active()->with(['service'])
            ->when($request->search, function ($builder, $value) {
                $builder->where('name', 'LIKE', "%{$value}%")
                    ->orWhere('services', 'LIKE', "%{$value}%")
                    ->orWhere('address', 'LIKE', "%{$value}%");
            })
            ->paginate(8);

        return view('front.contractors.index', compact('contractores'));
    }
}
