<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> وصف عمل الموقع </li>
    <li class="breadcrumb-item active"> انشاء وصف الية عمل الموقع </li>
    @endsection

    <form action="{{route('dashboard.work.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.works._form' , [
        'button' => ' حفظ '])

    </form>



</x-dashboard-layout>