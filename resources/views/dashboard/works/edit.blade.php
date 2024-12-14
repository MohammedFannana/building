<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> وصف عمل الموقع </li>
    <li class="breadcrumb-item active"> تعديل وصف الية عمل الموقع </li>
    @endsection

    <form action="{{route('dashboard.work.update' , $work->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('dashboard.works._form' , [
        'button' => ' تعديل '])

    </form>



</x-dashboard-layout>