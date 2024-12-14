<x-dashboard-layout title="لوحة التحكم">


    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> وصف الية عمل الموقع</li>

    @endsection

    <!-- Main content -->
    @if($work_count == 0)
    <div class="mb-3" style="margin-right: 8px;">
        <a href="{{route('dashboard.work.create')}}" class="btn btn-outline-primary"> انشاء وصف لالية عمل الموقع</a>
    </div>
    @endif


    <!-- invoke component alert components -->
    <x-alert type="success" name="success" />


    <div class="table-responsive">
        <table class="table table-striped text-center" dir="rtl">
            <thead class="text-white " style="background-color: #009fbf;">
                <th>#</th>
                <th> وصف الية عمل الموقع</th>
                <th> الفيديو </th>
                <th>التحكم</th>
            </thead>

            <tbody>

                @if($work_count > 0)

                <tr>
                    <td>{{$work->id}}</td>
                    <td>{{$work->description}}</td>
                    <td> <video src="{{asset('storage/' . $work->video)}}" alt="" width="100px" autoplay controls> </video> </td>

                    <td>
                        <a href="{{route('dashboard.work.edit',$work->id)}}">
                            <i class="fas fa-pen text-success fs-4"></i>
                        </a>
                    </td>



                </tr>

                @else

                <tr>
                    <td colspan="8"> لا يوجد وصف الية عمل الموقع. </td>
                </tr>

                @endif


            </tbody>

        </table>
    </div>


    <!-- /.content -->

</x-dashboard-layout>