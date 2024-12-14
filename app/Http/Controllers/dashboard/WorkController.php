<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $work = Work::first();
        $work_count = Work::get()->count();

        return view('dashboard.works.index', compact('work', 'work_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create_how_work');
        return view('dashboard.works.create', [
            'work' => new Work()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create_how_work');

        $valideted = $request->validate([
            'description' => ['required', 'string'],
            'video' => ['required'],
        ]);

        if ($request->hasFile('video')) {    //to check if image file is exit
            $file = $request->file('video');
            $path = $file->store('videos', 'public');  //store image in public disk insde storge folder inside uploads folder ,'public' or['disk' => 'public]

            $valideted['video'] = $path;
        }

        Work::create($valideted);
        return redirect()->route('dashboard.work.index')->with('success', 'تم انشاء وصف لطريقة عمل الموقع  بنجاح');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $work = Work::findOrFail($id);
        return view('dashboard.works.edit', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valideted = $request->validate([
            'description' => ['string'],
            'video' => ['video', 'dimensions:min_width=100,min_height=100'],
        ]);


        $work = Work::findOrFail($id);

        $validated = $request->except('video');
        $old_video = $request->video;

        if ($request->hasFile('video')) {
            $file = $request->file('video');

            $path = $file->store('/videos', 'public');

            $validated['video'] = $path;
        }

        $work->update($validated);

        //after update 
        if ($old_video && $old_video != $request->video) {
            Storage::disk('public')->delete($old_video);
        }
        return redirect()->back()->with('success', 'تم تعديل وصف لطريقة عمل الموقع بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
