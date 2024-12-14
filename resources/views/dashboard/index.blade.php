<x-dashboard-layout title="لوحة التحكم">
    <x-alert type="success" name="success" />


    <div class="row" dir="rtl" style="margin-right: 5px;">
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-info">

                <div class="inner" dir="ltr">
                    <h3>
                        {{DB::table('users')->where('user_type' , '=' ,'client')->count();}}
                    </h3>

                    <p> عدد المستخدمين </p>
                </div>

                <div class="icon">
                    <i class="fas fa-user" style="right:75%;"></i>
                </div>

                <a href="{{route('dashboard.user.index')}}" class="small-box-footer"> قراءة المزيد <i class="fas fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <!-- ./col -->

        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-success">

                <div class="inner" dir="ltr">
                    <h3>
                        {{DB::table('users')->where('user_type' , '=' ,'provider')->count();}}
                    </h3>

                    <p> عدد مقدمي الخدمة </p>
                </div>

                <div class="icon">
                    <i class="fas fa-house-user" style="right:75%;"></i>
                </div>

                <a href="{{route('dashboard.provider.index')}}" class="small-box-footer"> قراءة المزيد <i class="fas fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <!-- ./col -->

        <div class="col-6">
            <!-- small box -->

            <div class="small-box bg-warning">

                <div class="inner text-white" dir="ltr">
                    <h3>
                        {{DB::table('services')->count();}}
                    </h3>

                    <p> عدد الخدمات المقدمة </p>
                </div>

                <div class="icon">
                    <i class="fas fa-building" style="right:75%;"></i>
                </div>

                <a href="{{route('dashboard.service.index')}}" class="small-box-footer" style="color: white !important;"> قراءة المزيد <i class="fas fa-arrow-circle-right text-white"></i></a>
            </div>

        </div>
        <!-- ./col -->

        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-danger">

                <div class="inner" dir="ltr">
                    <h3>
                        {{DB::table('overflow_materials')->count();}}
                    </h3>

                    <p> عدد المواد الفائضة </p>
                </div>

                <div class="icon">
                    <i class="fas fa-plus" style="right:75%;"></i>
                </div>

                <a href="{{route('dashboard.material.index')}}" class="small-box-footer"> قراءة المزيد <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>



</x-dashboard-layout>