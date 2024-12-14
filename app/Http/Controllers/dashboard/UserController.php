<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $select_show = $request->query('select_show');


        $users = User::where('type', '=', 'user')
            ->where('user_type', '=', 'client')
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
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create', [
            'user' => new User()
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
            'user_type' => 'client',
            'subscription_end_data' => Carbon::now()->addMonth(),
            'is_subscribed' => 'false',
        ]);

        $valideted = $request->validate([
            'phone' => ['required', Rule::unique('users')],
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'status' => ['required', 'in:نشط,غير نشط'],
            'image' => ['nullable', 'image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'agree_condition' => ['string', 'in:true'],
            'type' => ['string', 'in:user'],
            'user_type' => ['string', 'in:client'],
        ]);

        if ($request->hasFile('image')) {    //to check if image file is exit
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');  //store image in public disk insde storge folder inside uploads folder ,'public' or['disk' => 'public]

            $valideted['image'] = $path;
        }

        Hash::make($valideted['password']);

        User::create($valideted);
        return redirect()->route('dashboard.user.index')->with('success', 'تم انشاء مستخدم بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', '=', $id)->first();
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.edit', compact('user'));
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
            'status' => ['in:نشط,غير نشط'],
        ]);


        $user = User::findOrFail($id);

        $user->update($valideted);

        return redirect()->back()->with('success', 'تم تعديل مقدم الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user->image || Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        return redirect()->route('dashboard.user.index')->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function freePeriod(Request $request)
    {
        Gate::authorize('free_period');

        $valideted = $request->validate([
            'day' => ['sometimes', 'required', 'date', 'after:2023-11-10']
        ]);

        // قم بالحصول على جميع المستخدمين
        $users = User::all();

        if ($request->has('day')) {
            $formattedDate = \Carbon\Carbon::parse($request->day)->toDateString();
        }

        // قم بتحديث subscription_end_data لكل مستخدم
        foreach ($users as $user) {
            $user->update([
                'subscription_end_data' => $formattedDate
            ]);
        };

        return redirect()->back()->with('success', 'تم تمديد الفترة المجانية بنجاح');
    }
}
