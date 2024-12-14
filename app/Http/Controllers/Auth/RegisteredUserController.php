<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Service;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\City;

class RegisteredUserController extends Controller
{

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $services = Service::all(['id', 'name']);
        $areas = Area::with('cities')->get();
        return view('auth.register', compact('services', 'areas'));
    }





    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:30', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'agree_condition' => ['required', 'in:true'],
            'user_type' => ['required', 'in:client,provider'],

            // *******************
            'service_id' => ['nullable', "required_if:user_type,==,provider", "exists:services,id"],
            'commercial_register' => ['nullable', 'int', 'unique:' . User::class],
            'career_id' => ['nullable', "required_if:user_type,==,provider", "exists:careers,id"],
            'area_id' => ['nullable', "required_if:user_type,==,provider", "exists:areas,id"],
            'city_id' => ['nullable', "required_if:user_type,==,provider", "exists:cities,id"],

        ]);

        if ($request->user_type === 'provider') {
            $time =  Carbon::now()->addMonth();
        } else {
            $time = null;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'agree_condition' => $request->agree_condition,
            'user_type' => $request->user_type,
            'status' => 'نشط',

            'subscription_end_data' => $time,
            'is_subscribed' => 'true',

            //************** */
            'commercial_register' => $request->commercial_register,
            'career_id' => $request->career_id,
            'area_id' => $request->area_id,
            'city_id' => $request->city_id,

            'service_id' => $request->service_id,
            /************** */
            'type' => 'user',
            'password' => Hash::make($request->password),
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
