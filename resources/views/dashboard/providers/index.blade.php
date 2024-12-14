<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">مقدمي الخدمات</li>

    @endsection

    <!-- Main content -->
    <div class="m-2 row flex-row-reverse">

        <div class="dropdown col-md-2">
            <button class="btn btn-outline-primary dropdown-toggle" style="width:100%" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                عرض حسب
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('dashboard.provider.index', ['select_show' => 'all']) }}">عرض الكل</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.provider.index', ['select_show' => 'active']) }}"> عرض النشط </a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard.provider.index', ['select_show' => 'inactive']) }}"> عرض الغير نشط </a></li>
            </ul>
        </div>

        <div class="col-md-8">
            <form action="{{route('dashboard.provider.index')}}" method="get" class="mb-3 d-flex" dir="rtl" style="gap: 5px;">
                <input type="search" name="search" placeholder="ابحث" class="form-control" autocomplete="NULL">
                <button type="submit" class="me-2 btn btn-primary ps-4 pe-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="col-md-2">
            <a href="{{route('dashboard.provider.create')}}" class="btn btn-outline-primary" style="width: 100%;"> انشاء مقدم خدمة</a>
        </div>

    </div>



    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />

    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th>الاسم</th>
                <th>رقم الجوال</th>
                <th>البريد الالكتروني</th>
                <th>نوع مقدم الخدمة</th>
                <th>نوع الخدمة</th>
                <th>حالة المستخدم</th>
                <th colspan="3">التحكم</th>
            </thead>

            <tbody>
                @forelse($providers as $provider)

                <tr>
                    <td>{{$provider->id}}</td>
                    <td>{{$provider->name}}</td>
                    <td>{{$provider->phone}}</td>
                    <td>{{$provider->email}}</td>
                    <td>{{$provider->service->name}}</td>
                    <td>{{$provider->services}}</td>
                    <td>{{$provider->status}}</td>

                    <td>
                        <a href="{{route('dashboard.provider.show',$provider->id)}}">
                            <i class="fas fa-info-circle text-success fs-4"></i>
                        </a>
                    </td>

                    <td>
                        <a href="{{route('dashboard.provider.edit',$provider->id)}}">
                            <i class="fas fa-pen text-secondary fs-4"></i>
                        </a>
                    </td>

                    <td>

                        <form action="{{route('dashboard.provider.destroy',$provider->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" style="border: none; background-color: transparent;">
                                <i class="fas fa-trash-alt fs-4 text-danger"></i>
                            </button>
                        </form>

                    </td>

                </tr>
                @empty

                <tr>
                    <td colspan="8"> .لا يوجد مقدمي خدمات </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>


    <!-- /.content -->

    {{$providers->withQueryString()->links()}}
</x-dashboard-layout>