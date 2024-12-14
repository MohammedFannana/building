<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">المسؤولون</li>

    @endsection

    <!-- Main content -->
    <div class="mb-3" style="margin-right: 8px;">
        <a href="{{route('dashboard.admin.create')}}" class="btn btn-outline-primary"> انشاء مسؤول</a>
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
                <th> نوع المسؤول </th>

                <th colspan="2">التحكم</th>
            </thead>

            <tbody>
                @forelse($admins as $admin)

                <tr>
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->phone}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->type}}</td>

                    <td>
                        <a href="{{route('dashboard.admin.edit',$admin->id)}}">
                            <i class="fas fa-pen text-success fs-4"></i>
                        </a>
                    </td>

                    <td>

                        <form action="{{route('dashboard.admin.destroy',$admin->id)}}" method="post">
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
                    <td colspan="8"> لا يوجد مسؤولون. </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>


    <!-- /.content -->

    {{$admins->withQueryString()->links()}}
</x-dashboard-layout>