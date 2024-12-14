<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\ImageOverflowMaterial;
use App\Models\OverflowMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Throwable;

class OverflowMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $select_materials = $request->query('select_materials');

        if ($select_materials === 'my_materials') {

            $materials = OverflowMaterial::where('user_id', '=', Auth::user()->id)->with(['user', 'images'])
                ->when($request->search, function ($builder, $value) {
                    $builder->where('material', 'LIKE', "%{$value}%");
                })
                ->paginate(8);
        } else {


            $materials = OverflowMaterial::with(['user', 'images'])
                ->when($request->search, function ($builder, $value) {
                    $builder->where('material', 'LIKE', "%{$value}%");
                })
                ->paginate(8);
        }

        return view('front.materials.index', compact('materials'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front.materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'images.*' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'images' => ['required', 'array'],
            'material' => ['required', 'string', 'max:250'],
            'quantity' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ]);

        DB::beginTransaction();

        try {


            $overflowMaterial = OverflowMaterial::create([
                'user_id' => Auth::user()->id,
                'material' => $request->material,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($request->file('images') as $image) {
                DB::table('image_overflow_materials')->insert([
                    'overflow_material_id' => $overflowMaterial->id,
                    'image' => $image->store('material', 'public'),
                ]);
            }




            DB::commit();

            return redirect()->route('materials.index')->with('success', 'تم اضافة المادة الفائضة بنجاح.');
        } catch (Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }



    public function edit(string $id)
    {
        $material = OverflowMaterial::findOrFail($id);

        Gate::authorize('edit_overflow_material', $material);

        return view('front.materials.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'images.*' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'images' => ['array'],
            'material' => ['string', 'max:250'],
            'quantity' => ['string'],
            'description' => ['string'],
        ]);

        $material = OverflowMaterial::findOrFail($id);

        Gate::authorize('edit_overflow_material', $material);

        $material->update($validated);
        return redirect()->back()->with('success', 'تم تعديل المادة المضافة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $material = OverflowMaterial::findOrFail($id);

        Gate::authorize('edit_overflow_material', $material);

        $images = $material->images->pluck('image');
        $material->delete();

        foreach ($images as $image) {
            $imagePath = public_path('storage/' . $image); // Get the full path to the image
            if (File::exists($imagePath)) {
                File::delete($imagePath); // Use PHP's unlink function to delete the file
            }
        }


        return redirect()->route('materials.index')->with('success', 'تم حذف  المادة الفائضة بنجاح');
    }
}
