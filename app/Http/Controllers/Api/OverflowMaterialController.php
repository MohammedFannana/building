<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OverflowMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Throwable;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Gate;



class OverflowMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $my_materials = $request->query('my_materials');
        $id = $request->query('id');


        if ($my_materials === 'true') {

            $materials = OverflowMaterial::where('user_id', '=', $id)->with(['user:image', 'images'])
                ->when($request->search, function ($builder, $value) {
                    $builder->where('material', 'LIKE', "%{$value}%");
                })
                ->paginate(8);
        } else {


            $materials = OverflowMaterial::with(['user:image', 'images'])
                ->when($request->search, function ($builder, $value) {
                    $builder->where('material', 'LIKE', "%{$value}%");
                })
                ->paginate(8);
        }

        return $materials;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'images' => ['required', 'array', 'min:1'],
            'material' => ['required', 'string', 'max:250'],
            'quantity' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'user_id' => ['required', 'exists:users,id']
        ]);


        DB::beginTransaction();

        try {

            $overflowMaterial = OverflowMaterial::create([
                'user_id' => $request->user_id,
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

            return response()->json(['message' => 'تم إضافة البيانات بنجاح'], 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => 'حدث خطأ أثناء إضافة البيانات'], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $validated = $request->validate([
            'images.*' => ['image', 'max:1048576', 'dimensions:min_width=100,min_height=100'],
            'images' => ['sometimes', 'required', 'array'],
            'material' => ['sometimes', 'required', 'string', 'max:250'],
            'quantity' => ['sometimes', 'required', 'string'],
            'description' => ['string'],
        ]);


        $material = OverflowMaterial::findOrFail($id);


        // التحقق من صلاحية تحرير المادة بواسطة المستخدم الحالي
        if ($material->user_id != $request->auth_id) {
            return response()->json(['message' => 'ليس لديك صلاحية تحرير هذه المادة'], 403);
        }


        $material->update($validated);

        return [
            'message' => 'تم تحديث البيانات بنجاح',
            'material' => $material,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $auth_id = $request->query('id');

        $material = OverflowMaterial::findOrFail($id);

        // التحقق من صلاحية تحرير المادة بواسطة المستخدم الحالي
        if ($material->user_id != $auth_id) {
            return response()->json(['message' => 'ليس لديك صلاحية تحرير هذه المادة'], 403);
        }

        $images = $material->images->pluck('image');
        $material->delete();

        foreach ($images as $image) {
            $imagePath = public_path('storage/' . $image); // Get the full path to the image
            if (File::exists($imagePath)) {
                File::delete($imagePath); // Use PHP's unlink function to delete the file
            }
        }

        return [
            'message' => 'تم حذف  المادة الفائضة بنجاح',
        ];
    }
}
