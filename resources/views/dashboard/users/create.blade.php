<x-dashboard-layout title="لوحة التحكم">



    @section('breadcrumb') <!-- Override into parent page dashboard page not display section parent page to show parent section use @parent   -->
    @parent
    <li class="breadcrumb-item active"> المستخدمين </li>
    <li class="breadcrumb-item active"> انشاءالمستخدم </li>
    @endsection

    <form action="{{route('dashboard.user.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        @include('dashboard.users._form' , [
        'button' => ' حفظ '])

    </form>



</x-dashboard-layout>