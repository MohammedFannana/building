<x-main-layout title=" عَمَاركم/المقاولون ">

    <div class="container postion bg-white rounded pt-4">

        <h1>قائمة المقاولين</h1>
        <p class="fs-4">
            ابحث معنا عن افضل المقاولين لتكون انت واعمالك بأمان
        </p>

        <div class="row">
            <!-- <div class="col-md-3 bg-black">
                <p class="fs-5">الخدمة المطلوبة </p>
            </div> -->

            <div class="col-md-10 m-auto">

                <form action="{{route('contractors.index')}}" method="get" class="mb-3 d-flex">
                    <input type="search" name="search" placeholder="ابحث" class="form-control" autocomplete="NULL">
                    <button type="submit" class="me-2 btn btn-primary ps-4 pe-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </form>


                @forelse($contractores as $contractor)

                <div class="card mb-3 border-0 " style="background-color: #F8F8F8;">
                    <div class="row g-0">

                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$contractor->name}}</h5>
                                <p class="card-text"> المهنة : {{$contractor->service->name }} {{$contractor->services}} </p>
                                <p class="card-text"> رقم الجوال : {{$contractor->phone}} </p>
                                <p class="card-text"> سنوات الخبرة : {{$contractor->experience_year}} سنوات</p>
                            </div>
                        </div>

                        <div class="col-md-3 m-auto">
                            <div class="d-flex align-items-center" style="flex-direction:column">


                                <img src="{{ $contractor->image_url}}" class="img-fluid rounded-start mb-3" alt="..." width="100px">
                                <a href="{{ route('whatsapp', ['phone' => $contractor->phone , 'message' => 'مرحبا أنا أتواصل معك من موقع اعماركم واريد الاستفسار منك عن الخدمة التي تقدمها']) }}" class="text-decoration-none text-white fs-5 p-1 ps-3 pe-3 rounded" style="background-color: #009FBF; width:fit-content;">تواصل</a>
                            </div>
                        </div>
                    </div>
                </div>

                @empty

                @endforelse

            </div>
        </div>

    </div>

    {{ $contractores->withQueryString()->links() }}

</x-main-layout>