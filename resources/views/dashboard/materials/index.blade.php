<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active">قائمة المواد الفائضة</li>

    @endsection


    <!-- Main content -->
    <div class="m-2 row flex-row-reverse">

        <div class="col-md-3">
            <a href="{{route('dashboard.material.create')}}" class="btn btn-outline-primary"> إضافة المواد الفائضة للبيع </a>
        </div>

        <div class="col-md-9">
            <form action="{{route('dashboard.material.index')}}" method="get" class="mb-3 d-flex" dir="rtl" style="gap: 5px;">
                <input type="search" name="search" placeholder="ابحث" class="form-control" autocomplete="NULL">
                <button type="submit" class="me-2 btn btn-primary ps-4 pe-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>



    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />

    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th> الاسم </th>
                <th> رقم الجوال </th>
                <th> المادة الفائضة </th>
                <th> الكمية </th>
                <th colspan="3">الصور</th>
                <th>التحكم</th>
            </thead>

            <tbody>
                @forelse($materials as $material)

                <tr>
                    <td>{{$material->id}}</td>
                    <td>{{$material->user->name}}</td>
                    <td>{{$material->user->phone}}</td>
                    <td>{{$material->material}}</td>
                    <td>{{$material->quantity}}</td>
                    @foreach ($material->images->pluck('image') as $imageUrl)
                    <td>
                        <img src="{{ asset('storage/' . $imageUrl) }}" alt="Image" class="img-fluid rounded-start" width="60px">
                    </td>
                    @endforeach


                    <td>
                        <form action="{{route('dashboard.material.destroy',$material->id)}}" method="post">
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
                    <td colspan="9"> لا يوجد اي مواد فائضة للبيع ! </td>
                </tr>

                @endforelse

            </tbody>

        </table>
    </div>


    <!-- /.content -->

    {{ $materials->withQueryString()->links() }}
</x-dashboard-layout>