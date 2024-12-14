<x-main-layout title="اعماركم">

    <!-- header -->
    <x-slot:header>

        <div class="container contant">

            <div class="row align-items-center">
                <div class="col-md-7 col-sm-12 text-white text">
                    <h3 class="mb-3">منصة اعماركم لاعمال البناء والتشطيب </h3>
                    <p class="fs-5">
                        الطريقة الأفضل لاختيار مقاول !!
                        <br>
                        ابحث عن مقاولين وفنيين وشركات انتاج ومصانع كن معنا بأمان انت واعمالك ,
                        <br>
                        مع عَمَاركم انت وعملك بأمان ....
                    </p>

                </div>

                <div class="col-md-5 col-sm-8">
                    <div class="image">
                        <img src="{{asset('image/header.png')}}" alt="" width="100%">

                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 673 179" fill="none">
                            <path d="M673 89.8605C673 139.014 522.344 178.861 336.5 178.861C150.656 178.861 0 139.014 0 89.8605C0 40.7072 150.656 0.860535 336.5 0.860535C522.344 0.860535 673 40.7072 673 89.8605Z" fill="#020101" fill-opacity="0.2" />
                        </svg>

                    </div>


                </div>
            </div>

        </div>

    </x-slot:header>

    <!--Start service -->

    <div class="section" style="background-color:#E7E7E7;">
        <div class="container">
            <div class="row">

                <h2 style="color: #009FBF;" class="text-center mb-5"> الخدمات المقدمة داخل الموقع! </h2>

                @foreach($services as $service)
                <div class="col-md-3">

                    <div class="bg-white rounded d-flex flex-column align-items-center p-2 mb-4">

                        <img src="{{asset('storage/'. $service->image)}}" alt="" width="70%" height="84px" class="mb-3">
                        <h4 style="color: #009FBF;">{{$service->name}}</h4>

                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- End service -->

    <!--Start service -->

    <div class="section" style="background-color:#E7E7E7;">
        <div class="container">
            <div class="row justify-content-center">

                <h2 style="color: #009FBF;" class="text-center mb-5"> ماذا تستطيع ان تعمل عبر الموقع </h2>

                @foreach ($services as $key => $service)
                <div class="col-md-10">

                    <div class="d-flex flex-column r p-2">

                        <h4 class="fw-bold" style="color: #009FBF;"> تعاقد مع {{$service->name}} </h4>
                        <p class="fs-4 pb-4" style="border-bottom:{{ $loop->last ? 'none' : '3px solid #009FBF;'}}">
                            {{$service->description}}
                        </p>


                    </div>

                </div>
                @endforeach


            </div>
        </div>
    </div>

    <!-- End service -->


</x-main-layout>