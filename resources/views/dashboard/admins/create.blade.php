<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> المسؤولون </li>
    <li class="breadcrumb-item active"> انشاء مسؤول </li>
    @endsection

    <form action="{{route('dashboard.admin.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.admins._form' , [
        'button' => ' حفظ '])

    </form>



</x-dashboard-layout>