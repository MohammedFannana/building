<?php

namespace App\Http\Controllers;

// use App\Http\Requests\ProfileUpdateRequest;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $services = Service::all(['id', 'name']);

        return view('profile.edit', [
            'user' => $request->user(),
            'services' => $services
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, String $id)
    {

        $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'phone' => ['max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'image' => ['image', 'required_if:image,==,null ', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            // *******************
            'experience_year' => ['nullable', "required_if:user_type,==,provider", 'int'],
            'service_id' => ["exists:services,id"],
            'commercial_register' => ['int'],
            'services' => ['string'],
            'address' => ['string'],
        ]);


        $user = User::findOrFail($id);


        $old_image = $user->image;

        $data = $request->except('image');

        if ($request->hasFile('image')) {    //to check if image file is exit
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');  //store image in public disk insde storge folder inside uploads folder ,'public' or['disk' => 'public]

            $data['image'] = $path;
        }


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
