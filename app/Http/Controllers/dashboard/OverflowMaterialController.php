<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OverflowMaterial;
use Illuminate\Support\Facades\Storage;
use App\Models\ImageOverflowMaterial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\File;

class OverflowMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $materials = OverflowMaterial::with(['user', 'images'])
            ->when($request->search, function ($builder, $value) {
                $builder->where('material', 'LIKE', "%{$value}%");
            })
            ->paginate(8);

        return view('dashboard.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.materials.create');
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

            $overflowMaterial =  OverflowMaterial::create([
                'user_id' => Auth::user()->id,
                'material' => $request->material,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            foreach ($request->file('images') as $image) {
                $data_image[] = [
                    'overflow_material_id' => $overflowMaterial->id,
                    'image' => $image->store('material', 'public'),
                ];
            }

            ImageOverflowMaterial::insert($data_image);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }


        return redirect()->route('dashboard.material.index')->with('success', 'تم اضافة المادة الفائضة بنجاح.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = OverflowMaterial::findOrFail($id);
        $images = $material->images->pluck('image');
        $material->delete();



        foreach ($images as $image) {
            $imagePath = public_path('storage/' . $image); // Get the full path to the image
            if (File::exists($imagePath)) {
                File::delete($imagePath); // Use PHP's unlink function to delete the file
            }
        }


        return redirect()->route('dashboard.material.index')->with('success', 'تم حذف  المادة الفائضة بنجاح');
    }
}
