<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> المسؤولون </li>
    <li class="breadcrumb-item active"> تعديل مسؤول </li>
    @endsection

    <form action="{{route('dashboard.admin.update' , $admin->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('dashboard.admins._form' , [
        'button' => ' تعديل '])

    </form>



</x-dashboard-layout>