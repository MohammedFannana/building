<!-- Phone -->
<div class="row" style="justify-content: flex-end;">
    <div class="col-md-6" style="margin-right: 15px;">

        <div>
            <x-form.input name="phone" class="border border-dark " type="text" label="رقم الجوال" :value="$admin->phone" autocomplete="" />
        </div>

        <!-- name -->
        <div class="mt-4">
            <x-form.input name="name" :value="$admin->name" class="border border-dark" type="text" label="الاسم" />
        </div>

        <!-- email -->
        <div class="mt-4">
            <x-form.input name="email" :value="$admin->email" class="border border-dark" type="text" label="البريد الالكتروني" />
        </div>



        <!-- status -->
        <div class="mt-4 ">
            <label> حالة الحساب </label> <br>
            <select class="form-select border border-dark form-control " name="status" class="is-invalid => $errors->has('status')" dir="rtl">
                <option value="نشط" @selected($admin->status == "نشط"
                    )> نشط </option>
                <option value="غير نشط" @selected($admin->status == "غير نشط"
                    )> غير نشط </option>

            </select>
            @error('status')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
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