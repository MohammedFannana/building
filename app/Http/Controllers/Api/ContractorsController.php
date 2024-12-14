<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ContractorsController extends Controller
{
    public function show(Request $request, string $id)
    {
        $request->validate([
            'service_id' => ["exists:services,id"],
        ]);

        $contractores = User::where('user_type', 'provider')
            ->where('service_id', $id)
            ->active()
            ->when($request->search, function ($builder, $value) {
                $builder->where('name', 'LIKE', "%{$value}%")
                    ->orWhere('services', 'LIKE', "%{$value}%");
            })
            ->paginate(8);

        return $contractores;
    }
}
