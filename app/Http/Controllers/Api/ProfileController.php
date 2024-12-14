<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->query('id');
        $user = User::where('id', '=', $id)->get();
        return $user;
    }


    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'max:255', Rule::unique(User::class)->ignore($id)],
            'phone' => ['sometimes', 'required', 'max:255', Rule::unique(User::class)->ignore($id)],
            'image' => ['image', 'sometimes', 'required', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            // *******************
            'experience_year' => ['sometimes', "required_if:user_type,==,provider", 'int'],
            'service_id' =>  ['sometimes', 'required', "exists:services,id"],
            'commercial_register' => ['sometimes', 'required', 'int'],
            'services' => ['sometimes', 'required', 'string'],
            'address' => ['sometimes', 'required', 'string'],
        ]);



        $user = User::findOrFail($id);

        $old_image = $user->image;

        $data = $request->except('image');

        if ($request->hasFile('image')) {    //to check if image file is exit
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');  //store image in public disk insde storge folder inside uploads folder ,'public' or['disk' => 'public]

            $data['image'] = $path;
        }


        $user->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }

        return [
            'message' => 'تم تحديث البيانات بنجاح',
            'user' => $user,
        ];
    }
}
