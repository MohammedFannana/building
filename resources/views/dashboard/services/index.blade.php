<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">الخدمات المقدمة</li>

    @endsection

    <!-- Main content -->
    <div class="mb-3" style="margin-right: 8px;">
        <a href="{{route('dashboard.service.create')}}" class="btn btn-outline-primary"> انشاء خدمة</a>
    </div>


    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />


    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th>اسم الخدمة</th>
                <th> الصورة </th>
                <th> الوصف </th>

                <th colspan="2">التحكم</th>
            </thead>

            <tbody>
                @forelse($services as $service)

                <tr>
                    <td>{{$service->id}}</td>
                    <td>{{$service->name}}</td>
                    <td> <img src="{{asset('storage/' . $service->image)}}" alt="" width="70px"> </td>
                    <td>{{$service->description}}</td>

                    <td>
                        <a href="{{route('dashboard.service.edit',$service->id)}}">
                            <i class="fas fa-pen text-success fs-4"></i>
                        </a>
                    </td>

                    <td>

                        <form action="{{route('dashboard.service.destroy',$service->id)}}" method="post">
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
                    <td colspan="8"> لا يوجد خدمات مقدمة. </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>


    <!-- /.content -->

    {{$services->withQueryString()->links()}}
</x-dashboard-layout>