<!-- this view is related with companant class  -->
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- style.css -->
    <link rel="stylesheet" href="{{asset('style.css')}}">

    <script src="{{asset('script.js')}}"></script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}"> <!--use asset with link to show css and js in all page -->

    <!-- font  -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet"> -->

    <!-- this var $title as pass from index in applay this component as attribute after go to class related with this compant view class -->
    <title> {{ $title}} </title>

    @stack('styles')

</head>

<body>


    <!-- start nav1 -->
    @guest
    <nav class="pt-1 bg-body-tertiary border-bottom" dir="ltr">
        <div class="container d-flex  align-items-center">
            <ul class="nav me-auto">
                <li class="nav-item" style="margin-right: 4px;"><a href="{{route('register')}}" class="btn btn-dark px-2">انشاء حساب</a></li>
                <li class="nav-item"><a href="{{route('login')}}" class="btn px-2 text-white" style="background-color: #009FBF;">تسجيل الدخول</a></li>
            </ul>

            <ul class="nav">
                <img src="{{asset('image/logo.png')}}" alt="" width="100px" height="65px">
            </ul>
        </div>
    </nav>
    @endguest

    <!-- End Nav 1 -->

    <!-- start header -->

    <header class="main_header">

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="d-flex align-items-center" style="gap: 10px;">

                    @guest
                    <img src="{{asset('image/logo.png')}}" alt="" width="45px" height="45px" class="rounded-circle" class="dropdown-toggle">

                    @endguest


                    @auth
                    <div class="dropdown">
                        <button class="dropdown-toggle bg-transparent p-1 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                            <img src="{{asset('image/logo.png')}}" alt="" width="45px" height="45px" class="rounded-circle" class="dropdown-toggle">
                        </button>


                        <ul class="dropdown-menu border-0" style="position: absolute;right: 0px; background-color:#66c5d9">

                            <li>
                                <a class=" dropdown-item block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" href="{{route('profile.edit')}}">الملف الشخصي</a>
                            </li>

                            <li>
                                <form method="POST" action="{{route('logout')}}" class="dropdown-item ps-0 pe-0">
                                    @csrf
                                    <a class="block text-decoration-none text-dark w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" href="{{route('logout')}}" onclick="event.preventDefault();
                                                this.closest('form').submit();">تسجيل الخروج </a>
                                </form>
                            </li>
                        </ul>

                    </div>
                    @endauth

                    <a class="nav-link t fs-5 ps-2" href="{{route('home')}}">الرئيسية</a>


                    <!-- Notifications Dropdown Menu -->
                    <!-- invoke notification component class -->
                    @auth
                    <x-notification.notification-menu count="7" />
                    @endauth


                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="flex: auto; padding-right:12px">

                        <li class="nav-item">
                            <a class="nav-link  fs-5" aria-current="page" href="{{route('contractors.index')}}">المقاولون</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link  fs-5" href="{{route('works.index')}}">كيف يعمل الموقع</a>
                        </li>


                    </ul>


                    <a href="{{route('materials.index')}}" class="btn btn-dark text-white"> عرض الفائض للبيع </a>
                </div>


            </div>
        </nav>


        {{$header ?? ''}}

    </header>


    <!-- end header -->

    <main>
        <!-- use component class main as layout  -->
        {{$slot}}
    </main>


    <!-- Start footer -->

    <!-- invoke view component -->
    <footer class="pt-5 pb-5">

        <div class="container">
            <div class="row">

                <div class="footer_list col-md-4 mb-2 d-flex align-items-center" style=" flex-direction:column">
                    <div class="image mb-2">
                        <img src="{{asset('image/logo.png')}}" alt="" width="100px" height="65px">
                    </div>
                    <p class="text-white fs-5">منصة اعماركم لاعمال البناء والتشطيب </p>
                </div>



                <div class="footer_list mb-2 col-md-4">
                    <div class="d-flex flex-column align-items-center ">
                        <a href="{{route('home')}}" class="nav-link p-0 text-body-secondary  mb-2">الرئيسية</a>
                        <a href="{{route('contractors.index')}}" class="nav-link p-0 text-body-secondary  mb-2">المقاولون </a>
                        <a href="{{route('works.index')}}" class="nav-link p-0 text-body-secondary  mb-2">كيفية استخدام التطبيق</a>
                        <a href="{{route('materials.index')}}" class="nav-link p-0 text-body-secondary  ">
                            عرض الفائض للبيع
                        </a>
                    </div>
                </div>


                <div class="footer_list col-md-4 mb-2">

                    <form action="" method="post" class="d-flex" style="flex-direction: column;">
                        <input name="" type="text" placeholder="ارسل بريدك" class="form-control mb-1 rounded-pill border border-white ">
                        <button type="submit" class="btn btn-dark rounded-pill" style="width: 100px;">ارسال</button>
                    </form>

                </div>

            </div>
        </div>

    </footer>

    <!-- End Footer -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    @stack('scripts')

</body>

</html>