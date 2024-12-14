<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

        <div>
            <x-form.input name="phone" class="border border-dark " type="text" label="رقم الجوال" :value="$provider->phone" autocomplete="" />
        </div>

        <!-- name -->
        <div class="mt-4">
            <x-form.input name="name" :value="$provider->name" class="border border-dark" type="text" label="الاسم" />
        </div>

        <!-- email -->
        <div class="mt-4">
            <x-form.input name="email" :value="$provider->email" class="border border-dark" type="text" label="البريد الالكتروني" />
        </div>


        <!-- provider -->

        <div class="row" style="flex-direction: row-reverse;">

            <div class="mt-4 col-md-6">
                <label> مقدم الخدمة </label>
                <select class="form-select form-control border border-dark" name="service_id" class=" is-invalid => $errors->has('service_id')" id="serviceProvider" dir="rtl">

                    <option value="">غير محدد</option>
                    @foreach($services as $service)
                    <option value="{{$service->id}}" @selected($provider->service_id == $service->id)> {{$service->name}} </option>
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
                <select class="form-control form-select border border-dark" name="career_id" id="career" dir="rtl">

                    <option value=""> يجب اختيار مقدم خدمة </option>
                    <option value="{{$career->id}}" selected> {{$career->name}} </option>

                </select>



                @error('career_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror

            </div>
        </div>



        <!-- status -->
        <div class="mt-4 ">
            <label> حالة الحساب </label> <br>
            <select class="form-select border border-dark form-control " name="status" class="is-invalid => $errors->has('status')" dir="rtl">
                <option value="نشط" @selected($provider->status == "نشط"
                    )> نشط </option>
                <option value="غير نشط" @selected($provider->status == "غير نشط"
                    )> غير نشط </option>

            </select>
            @error('status')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <!-- commercial register -->
        <div class="mt-4">
            <x-form.input name="commercial_register" class="border border-dark" type="text" label="السجل التجاري" :value="$provider->commercial_register" />
        </div>



        <!-- address -->
        <div class="row" style="flex-direction: row-reverse;">
            <div class="mt-4 col-md-6">
                <label> المنطقة </label>
                <select class="form-control form-select border border-dark" name="area_id" class=" is-invalid => $errors->has('area_id')" id="areaSelect" dir="rtl">

                    <option value=""> غير محدد </option>
                    @foreach($areas as $area)
                    <option value="{{$area->id}}" @selected($provider->area_id == $area->id)> {{$area->name}} </option>
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


                <select class="form-control form-select border border-dark" name="city_id" id="citySelect" dir="rtl">

                    <option value=""> يجب اختيار المنطقة </option>
                    <option value="{{$provider->city->id}}" selected> {{$provider->city->name}} </option>

                    
                </select>


                @error('city_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror

                <input type="hidden" name="cityValue" id="cityValue" value="{{$provider->city_id}}">

            </div>

        </div>
        <!-- experience year -->
        <div class="mt-4">
            <x-form.input name="experience_year" class="border border-dark" type="number" label=" سنوات الخبرة " :value="$provider->experience_year" />
        </div>

        @if($button == " حفظ ")

        <!-- Password -->
        <div class="mt-4">
            <x-form.input name="password" class="border border-dark" type="password" label="كلمة المرور" autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-form.input name="password_confirmation" class="border border-dark" type="password" label=" تأكيد كلمة المرور  " autocomplete="new-password" />
        </div>



        <!-- image -->
        <div class="mt-4">
            <x-form.input name="image" class="border border-dark" type="file" label="الصورة" />
        </div>

        @endif

        <div class="flex items-center gap-4 mt-4">
            <button class="btn text-white mb-4" style="background-color:#009FBF;padding-right: 20px; padding-left: 20px;" type="submit"> {{$button}} </button>
        </div>
    </div>
</div>