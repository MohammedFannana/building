<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">مقدمي الخدمات </li>
    <li class="breadcrumb-item active">تفاصيل مقدم الخدمات </li>

    @endsection

    <div class="row" style="margin-top:120px">
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h4 class="mb-3">{{$provider->name}}</h4>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> رقم الجوال </strong>
                        <p> {{$provider->phone}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> البريد الالكتروني </strong>
                        <p> {{$provider->email}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> مقدم الخدمة </strong>
                        <p> {{$provider->service->name}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> السجل التجاري </strong>
                        <p> {{$provider->commercial_register}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> المهنة </strong>
                        <p> {{$provider->career($provider->id)->name}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> العنوان</strong>
                        <p> {{$provider->area->name }} / {{$provider->city->name }} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> سنوات الخبرة </strong>
                        <p> {{$provider->experience_year}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> حالة الحساب </strong>
                        <p> {{$provider->status}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> الحساب صالح حتى </strong>
                        <p> {{$provider->subscription_end_data }} :</p>
                    </div>

                </div>
                <div class="col-auto d-none d-sm-block" style="background-color: #77777717">
                    <img src="{{$provider->image_url}}" alt="" width="200" height="250">
                </div>
            </div>
        </div>
    </div>



    <!-- /.content -->

</x-dashboard-layout>