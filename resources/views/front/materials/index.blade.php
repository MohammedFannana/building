<x-main-layout title=" عَمَاركم/المواد الفائضة ">


    <div class="container postion bg-white rounded pt-4">

        <div class="row">

            <div class="col-md-10 m-auto">

                <div class="d-flex justify-content-between  align-items-center mb-3">
                    <h1>قائمة المواد الفائضة</h1>

                    <a href="{{route('materials.create')}}" class="btn btn-outline-primary" style="height: fit-content"> إضافة المواد الفائضة للبيع </a>
                </div>

                <div class="d-flex" style="gap: 15px;">

                    <div>
                        <div class="d-flex" style="gap: 20px;">
                            <a href="{{ route('materials.index', ['select_materials' => 'all_materials']) }}" class="btn btn-primary p-1  mb-1" style="width:100%">عرض الكل</a>
                        </div>
                        <div>
                            <a href="{{ route('materials.index', ['select_materials' => 'my_materials']) }}" class="btn btn-primary p-1  mb-1">عرض المواد الخاصة بي</a>
                        </div>
                    </div>

                    <form action="{{route('materials.index')}}" method="get" class="mb-3 d-flex" style="width:calc(100% - 177px)">
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
        </div>



        <div class="row">
            <div class="col-md-10 m-auto">

                @forelse($materials as $material)

                <div class="card mb-3 border-0 " style="background-color: #F8F8F8;">
                    <div class="row flex-row-reverse g-0">

                        <div class="col-md-3 m-auto">
                            <div class="d-flex align-items-center" style="flex-direction:column">

                                <div class="d-flex">

                                    <img src="{{$material->user->image_url }}" alt="image" class="img-fluid rounded-start mb-3" width="60px">

                                </div>

                                <a class="btn text-white" style="background-color: #009FBF; width:fit-content;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> عرض المزيد </a>
                            </div>
                        </div>

                        <div class="col-md-8">

                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">{{$material->user->name}}</h5>
                                    <p class="card-text"> المادة الفائضة : {{$material->material}} </p>
                                    <p class="card-text"> الكمية : {{$material->quantity}} </p>
                                    <p class="card-text"> رقم الجوال : {{$material->user->phone}} </p>
                                    <div class="collapse" id="collapseExample">
                                        صور المادة
                                        <div class="d-flex" style="gap:20px">
                                            @foreach ($material->images->pluck('image') as $imageUrl)
                                            <div style="width: 90px;">
                                                <img src="{{ asset('storage/' . $imageUrl) }}" alt="Image" class="img-fluid rounded-start mb-3" width="100%">
                                            </div>
                                            @endforeach
                                        </div>

                                        <div class="d-flex align-items-center" style="gap: 10px;">
                                            <a href="{{ route('whatsapp', ['phone' => $material->user->phone, 'message' => 'مرحبا أنا أتواصل معك من موقع اعماركم واريد الاستفسار منك عن الخدمة التي تقدمها']) }}" class="btn btn-primary p-1 ps-3 pe-3 " style=" height:fit-content;">تواصل</a>

                                            @if($material->user_id === Auth::user()->id)

                                            <div class="d-flex" style="gap: 15px;">
                                                <a class="btn btn-secondary  p-1 ps-3 pe-3" href="{{route('materials.edit',$material->id)}}">تعديل</a>

                                                <form action="{{route('materials.destroy',$material->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="btn btn-danger p-1 ps-3 pe-3">حذف</button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>


                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                @empty

                <div class="alert alert-primary" role="alert">
                    <p class="fs-5">لا يوجد اي مواد فائضة للبيع ! </p>
                </div>

                @endforelse
            </div>

        </div>
    </div>

    </div>

    {{ $materials->withQueryString()->links() }}




</x-main-layout>