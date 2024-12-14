<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = User::where('type', '=', 'admin')
            ->orWhere('type', '=', 'super_admin')
            ->paginate(8);
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admins.create', [
            'admin' => new User()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'agree_condition' => 'true',
            'type' => 'admin',
            'user_type' => 'client',
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
        return redirect()->route('dashboard.admin.index')->with('success', 'تم انشاء المسؤول بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = User::where('id', '=', $id)->first();
        return view('dashboard.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = User::findOrFail($id);
        return view('dashboard.admins.edit', compact('admin'));
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

        return redirect()->back()->with('success', 'تم تعديل بيانات المسؤول  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        if ($admin->image || Storage::disk('public')->exists($admin->image)) {
            Storage::disk('public')->delete($admin->image);
        }
        return redirect()->route('dashboard.admin.index')->with('success', 'تم حذف المسؤول بنجاح');
    }
}
