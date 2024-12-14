<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">قائمة المواد الفائضة</li>
    <li class="breadcrumb-item active"> إضافة مادة فائضة </li>


    @endsection


    <div class="row" style="justify-content: flex-end;">
        <div class="col-md-6" style="margin-right: 15px;">

            <form action="{{route('dashboard.material.store')}}" method="post" enctype="multipart/form-data">
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
    </div>

</x-dashboard-layout>