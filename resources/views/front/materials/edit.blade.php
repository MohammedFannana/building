<x-main-layout title=" عَمَاركم/تعديل المادة الفائضة ">

    @push('styles')
    <style>
        @media(max-width:767px) {
            .material_img {
                display: none
            }
        }
    </style>
    @endpush

    <div class="container postion bg-white rounded pt-4">
        <div class="row align-items-center">

            <h2 class="text-center" style="color:#009FBF ;">تعديل المواد الفائضة</h2>


            <div class="col-md-6">

                <form action="{{route('materials.update' , $material->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    <!-- name material -->
                    <div class="mt-4">
                        <x-form.input name="material" class="border border-dark" type="text" label="المادة الفائضة" :value="$material->material" />
                    </div>

                    <!-- quantity -->
                    <div class="mt-4">
                        <x-form.input name="quantity" class="border border-dark" type="text" label="الكمية" :value="$material->quantity" />
                    </div>


                    <!-- descripton -->
                    <div class="mt-4">
                        <x-form.textarea name="description" :value="$material->description" class="border border-dark" type="text" label=" وصف المادة" />
                    </div>


                    <div class="d-flex align-items-center mt-3 " style="gap: 20px;">
                        @foreach ($material->images->pluck('image') as $imageUrl)
                        <div>
                            <img src="{{ asset('storage/' . $imageUrl) }}" alt="Image" class="img-fluid rounded-start" width="80px">
                        </div>
                        @endforeach
                    </div>


                    <div class="flex items-center gap-4 mt-4">
                        <button class="btn text-white mb-4" style="background-color:#009FBF;padding-right: 20px; padding-left: 20px;" type="submit"> تعديل </button>
                    </div>


                </form>
            </div>

            <div class="col-md-6">

                <img class="material_img" src="{{asset('image/material.png')}}" alt="" width="100%">

            </div>

        </div>
    </div>

</x-main-layout>