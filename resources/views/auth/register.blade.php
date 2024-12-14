<x-main-layout title="اعماركم">

    @push('styles')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @endpush

    <div class="register_login row" style="font-size: 18px; font-family: auto;">
        <div class="col-md-5 m-auto">

            <a class="btn button" style="background-color:transparent;" href="{{route('login')}}"> الدخول </a>
            <a class="btn button btn-light border border-0"> التسجيل </a>

            <form method="post" action="{{ route('register') }}" class="rounded">
                @csrf

                <p style="font-size: 20px;"> نموذج انشاء الحساب </p>


                <div class="d-flex" style="gap: 30px;">
                    <div dir="ltr" style="text-align:end">
                        <label class="form-check-label" for="customerRadio"> مستخدم </label>
                        <input class="form-check-input" type="radio" name="user_type" id="customerRadio" value="client" checked>
                    </div>

                    <div dir="ltr">
                        <label class="form-check-label" for="providerRadio"> مقدم خدمة </label>
                        <input class="form-check-input" type="radio" name="user_type" id="providerRadio" value="provider">
                    </div>

                </div>

                <!--Phone-->
                <div class="mt-4">
                    <x-form.input name="phone" for="phone" class="border border-dark" type="text" label="رقم الجوال" autofocus />
                </div>

                <!--name-->
                <div class="mt-4">
                    <x-form.input name="name" for="name" class="border border-dark" type="text" label="الاسم" />
                </div>


                <div class="mt-4">
                    <x-form.input name="email" for="email" class="border border-dark" type="email" label=" البريد الالكتروني  " />
                </div>

                <div id="providerInputs" class="hidden">

                    <div class="row">

                        <div class="mt-4 col-md-6">
                            <label> مقدم الخدمة </label>
                            <select class="form-select border border-dark" name="service_id" class=" is-invalid => $errors->has('service_id')" id="serviceProvider">

                                <option value="">غير محدد</option>
                                @foreach($services as $service)
                                <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach

                            </select>

                            @error('service_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                        </div>


                        <div class="mt-4 col-md-6">
                            <label> المهنة </label>
                            <select class="form-select border border-dark" name="career_id" id="career" disabled>

                                <option value=""> يجب اختيار مقدم خدمة </option>
                            </select>



                            @error('career_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>

                    <div class="mt-4">
                        <x-form.input name="commercial_register" class="border border-dark" type="text" label="السجل التجاري" />
                    </div>

                    <div class="row">
                        <div class="mt-4 col-md-6">
                            <label> المنطقة </label>
                            <select class="form-select border border-dark" name="area_id" class=" is-invalid => $errors->has('area_id')" id="areaSelect">

                                <option value=""> غير محدد </option>
                                @foreach($areas as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach

                            </select>

                            @error('area_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                        </div>


                        <div class="mt-4 col-md-6">
                            <label> المدينة </label>
                            <select class="form-select border border-dark" name="city_id" id="citySelect" disabled>

                                <option value=""> يجب اختيار المنطقة </option>

                            </select>


                            @error('city_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                    </div>

                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-form.input name="password" class="border border-dark" type="password" label="كلمة المرور" autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-form.input name="password_confirmation" class="border border-dark" type="password" label=" تأكيد كلمة المرور  " autocomplete="new-password" />
                </div>

                <div class="mt-4  mb-3">
                    <input class="form-check-input" type="checkbox" name="agree_condition" value="true" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        اوافق على الشروط والسياسات
                    </label>
                </div>

                <button class="btn text-white form-control" style="background-color:#009FBF;" type="submit">سجل الان </button>

            </form>

        </div>

    </div>


</x-main-layout>

<script>
    //for area and city
    async function getCities() {
        try {
            const response = await fetch(`{{route('cities')}}`)
            const data = await response.json()
            return data
        } catch (err) {
            console.log(err)
        }
    }
    var selectedValue = 1;
    $(document).ready(function() {
        // استدعاء الوظيفة عند تغيير القيمة في الـ select
        $('#areaSelect').change(function() {
            // الحصول على القيمة المختارة من الـ select
            selectedValue = $(this).val();
            const cities = getCities().then(da => {
                const selectedCities = da.filter(item => item.area_id == selectedValue)
                const selectElment = document.getElementById('citySelect')
                appendOptions(selectedCities, "citySelect")

                // إذا كان لا يوجد مدن متاحة، قم بتعطيل الـ select الخاص بالمدينة
                if (selectedCities.length === 0) {
                    selectElment.disabled = true;
                } else {
                    selectElment.disabled = false;
                }

            })
        })
    })


    //for service provider and career

    async function getCareer() {
        try {
            const response = await fetch(`{{route('career')}}`)
            const data = await response.json()
            return data
        } catch (err) {
            console.log(err)
        }
    }
    var selectedValue1 = 1;
    $(document).ready(function() {
        // استدعاء الوظيفة عند تغيير القيمة في الـ select
        $('#serviceProvider').change(function() {
            // الحصول على القيمة المختارة من الـ select
            selectedValue1 = $(this).val();
            const cities = getCareer().then(da => {
                const selectedCareer = da.filter(item => item.service_id == selectedValue1)
                const selectElment = document.getElementById('career')
                appendOptions(selectedCareer, "career")

                if (selectedCareer.length === 0) {
                    selectElment.disabled = true;
                } else {
                    selectElment.disabled = false;
                }

            })
        })
    })

    function appendOptions(data, selectedId) {
        $(`#${selectedId}`).empty()
        data.map(item => {
            const option = document.createElement('option')
            option.value = item.id
            option.innerHTML = item.name
            return (
                document.getElementById(selectedId).appendChild(option)
            )
        })
    }
</script>