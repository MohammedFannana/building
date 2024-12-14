<x-main-layout title=" عَمَاركم/اضافةالمواد الفائضة ">

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

            <h2 class="text-center" style="color:#009FBF ;">إضافة المواد الفائضة</h2>


            <div class="col-md-6">

                <form action="{{route('overflow.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- name material -->
                    <div class="mt-4">
                        <x-form.input name="material" class="border border-dark" type="text" label="المادة الفائضة" />
                    </div>

                    <!-- quantity -->
                    <div class="mt-4">
                        <x-form.input name="quantity" class="border border-dark" type="text" label="الكمية" />
                    </div>

                    <!-- descripton -->
                    <div class="mt-4">
                        <x-form.textarea name="description" class="border border-dark" type="text" label=" وصف المادة" />
                    </div>

                    <!-- image -->
                    <div class="mt-4">
                        <x-form.input name="images[]" class="border border-dark" type="file" label="الصورة" multiple />
                    </div>

                    <!-- image -->
                    <div class="mt-4">
                        <x-form.input name="images[]" class="border border-dark" type="file" label="الصورة" multiple />
                    </div>

                    <!-- image -->
                    <div class="mt-4">
                        <x-form.input name="images[]" class="border border-dark" type="file" label="الصورة" multiple />
                    </div>


                    <div class="flex items-center gap-4 mt-4">
                        <button class="btn text-white mb-4" style="background-color:#009FBF;padding-right: 20px; padding-left: 20px;" type="submit"> حفظ </button>
                    </div>

                </form>

            </div>

            <div class="col-md-6">

                <img class="material_img" src="{{asset('image/material.png')}}" alt="" width="100%">

            </div>


        </div>
    </div>

</x-main-layout>