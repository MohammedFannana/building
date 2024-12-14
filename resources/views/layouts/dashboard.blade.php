<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title> <!-- get name in config file -->


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}"> <!--use asset with link to show css and js in all page -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Font Awesome -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">



    @stack('styles')


</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav " dir="rtl">


                <!-- Notifications Dropdown Menu -->
                <!-- invoke notification component class -->
                {{-- <!-- <x-dashboard.notification-menu count="7" /> --> --}}

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>


            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto" dir="rtl">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('dashboard.dashboard')}}" class="nav-link">الرئيسية</a>
                </li>


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link d-flex justify-content-end">
                <span class="brand-text font-weight-light">{{config('app.name')}}</span>
                <img src="{{asset('image/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                @auth <!-- Check if user is auth == true action code  ==>if(auth::check()) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-end" style="margin-right: 8px;">

                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>

                    <div class="image">
                        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>

                </div>

                @endauth



                <!-- SidebarSearch Form -->
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn  btn-outline-primary" style="width: 100%;"> تسجيل الخروج </button>
                </form>

                <x-nav />

            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">

                    <div class="row  mb-2" style="flex-direction: row-reverse">

                        <div class="col-sm-6" style="    text-align: end;">
                            <h1 class="m-0">{{$title}}</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                @section('breadcrumb')
                                <li class="breadcrumb-item">الرئيسية</li>
                                @show <!-- To Show This Section in this page like @yiled-->
                            </ol>
                        </div><!-- /.col -->

                    </div><!-- /.row -->

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div style="text-align: end;">
                {{$slot}} <!-- use to show section name is content -->
            </div>

        </div>


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

    </div>

    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script> <!-- use asset() in all css and js link to implement in all page with no error-->
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


    <script>
        const userID = "{{ Auth::id() }}";
    </script>
    <!-- <script src="{{asset('js/app.js')}}"></script> -->


    @stack('scripts')

</body>

</html>