<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> المسؤولون </li>
    <li class="breadcrumb-item active"> تفاصيل المسؤول </li>

    @endsection

    <div class="row" style="margin-top:120px">
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h4 class="mb-3">{{$admin->name}}</h4>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> رقم الجوال </strong>
                        <p> {{$admin->phone}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> البريد الالكتروني </strong>
                        <p> {{$admin->email}} :</p>
                    </div>

                    <div class="card-text d-flex flex-row-reverse">
                        <strong style="width: 120px;"> حالة الحساب </strong>
                        <p> {{$admin->status}} :</p>
                    </div>

                </div>
                <div class="col-auto d-none d-sm-block" style="background-color: #77777717">
                    <img src="{{$admin->image_url}}" alt="" width="200" height="250">
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->

</x-dashboard-layout>