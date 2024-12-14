<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> الخدمات </li>
    <li class="breadcrumb-item active"> تعديل الخدمة </li>
    @endsection

    <form action="{{route('dashboard.service.update' , $service->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('dashboard.services._form' , [
        'button' => ' تعديل '])

    </form>



</x-dashboard-layout>