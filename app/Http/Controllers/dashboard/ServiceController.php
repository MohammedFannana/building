<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::paginate(8);
        return view('dashboard.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create', [
            'service' => new Service()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valideted = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'image' => ['required', 'image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'description' => ['required', 'string']

        ]);

        if ($request->hasFile('image')) {    //to check if image file is exit
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');  //store image in public disk insde storge folder inside uploads folder ,'public' or['disk' => 'public]

            $valideted['image'] = $path;
        }

        Service::create($valideted);
        return redirect()->route('dashboard.service.index')->with('success', 'تم انشاء الخدمة بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['string'],
            'description' => ['string'],
            'image' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],

        ]);

        $provider = Service::findOrFail($id);

        $validated = $request->except('image');


        $old_image = $request->image;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->store('/uploads', 'public');

            $validated['image'] = $path;
        }

        $provider->update($validated);

        //after update 
        if ($old_image && $old_image != $request->image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->back()->with('success', 'تم تعديل الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        if ($service->image || Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }
        return redirect()->route('dashboard.service.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
}
