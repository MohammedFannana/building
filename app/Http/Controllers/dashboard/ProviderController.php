<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $select_show = $request->query('select_show');


        $providers = User::where('type', '=', 'user')->with(['service'])
            ->where('user_type', '=', 'provider')
            ->when($select_show === 'active', function ($query) {
                $query->where('status', '=', 'نشط');
            })
            ->when($select_show === 'inactive', function ($query) {
                $query->where('status', '=', 'غير نشط');
            })
            ->when($request->search, function ($builder, $value) {
                $builder->where('name', 'LIKE', "%{$value}%");
            })
            ->paginate(8);

        return view('dashboard.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all(['id', 'name']);
        $areas = Area::all(['id', 'name']);
        

        return view('dashboard.providers.create', [
            'provider' => new User(),
            'services' => $services,
            'areas' => $areas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->merge([
            'agree_condition' => 'true',
            'type' => 'user',
            'user_type' => 'provider',
            'subscription_end_data' =>  Carbon::now()->addMonth(),
            'is_subscribed' => 'true',
        ]);



        $valideted = $request->validate([
            'phone' => ['required', Rule::unique('users')],
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'service_id' => ['required', 'exists:services,id'],
            'commercial_register' => ['nullable', 'numeric', Rule::unique('users')],
            'career_id' => ['required', 'exists:careers,id'],
            'area_id' => ['required', 'exists:areas,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'experience_year' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:نشط,غير نشط'],
            'image' => ['nullable', 'image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'agree_condition' => ['string', 'in:true'],
            'type' => ['string', 'in:user'],
            'user_type' => ['string', 'in:provider'],

        ]);

        if ($request->hasFile('image')) {    //to check if image file is exit
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');  //store image in public disk insde storge folder inside uploads folder ,'public' or['disk' => 'public]

            $valideted['image'] = $path;
        }

        Hash::make($valideted['password']);

        User::create($valideted);
        return redirect()->route('dashboard.provider.index')->with('success', 'تم انشاء مقدم الخدمة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $provider = User::where('id', '=', $id)->with(['service'])->first();
        return view('dashboard.providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $services = Service::all(['id', 'name']);
        $areas = Area::all(['id', 'name']);
        $provider = User::findOrFail($id);
        $career  = $provider->career($id);
        return view('dashboard.providers.edit', compact('provider', 'services', 'areas' ,'career'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valideted = $request->validate([
            'phone' => [Rule::unique(User::class)->ignore($id)],
            'name' => ['string', 'min:3'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($id)],
            'service_id' => ['exists:services,id'],
            'commercial_register' => ['numeric', Rule::unique(User::class)->ignore($id)],
            'career_id' => ['exists:careers,id'],
            'area_id' => ['exists:areas,id'],
            'city_id' => ['exists:cities,id'],
            'experience_year' => ['numeric', 'min:0'],
            'status' => ['in:نشط,غير نشط'],
        ]);

        $provider = User::findOrFail($id);

        $provider->update($valideted);

        return redirect()->back()->with('success', 'تم تعديل مقدم الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provider = User::findOrFail($id);
        $provider->delete();

        if ($provider->image || Storage::disk('public')->exists($provider->image)) {
            Storage::disk('public')->delete($provider->image);
        }
        return redirect()->route('dashboard.provider.index')->with('success', 'تم حذف مقدم الخدمة بنجاح');
    }
}
