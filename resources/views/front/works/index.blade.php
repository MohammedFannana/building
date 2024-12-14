<x-main-layout title="كيف يعمل الموقع/عَمَاركم">

    <!-- header -->
    <x-slot:header>

        <div class="container contant">

            <div class="row align-items-center">
                <div class="col-md-7 col-sm-12 text-white text">
                    <h3 class="mb-3">منصة اعماركم لاعمال البناء والتشطيب </h3>
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


    <div class="container section">

        <div class="row">
            <div class="col-md-5" style="color: #009FBF;">
                <h1 class="mb-5"> كيف يعمل الموقع ! </h1>
                <p class="fs-5">{{$work->description ?? ''}} </p>
            </div>

            <div class="col-md-7">

                <video src="{{'storage/' . $work->video }}" width="90%" muted autoplay controls></video>

            </div>

        </div>

    </div>


</x-main-layout>