<section class="postion row">
    <div class="col-md-5 bg-white m-auto p-3 rounded">

        <div class="image mb-4 d-flex justify-content-center">
            <img src="{{ $user->image_url}}" alt="" width="220px" height="220px" class="rounded-circle">
        </div>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>


        <form method="post" action="{{ route('profile.update', $user->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <!-- Phone -->
            <div>
                <x-form.input name="phone" class="border border-dark " type="text" label="رقم الجوال" :value="$user->phone" />
            </div>

            <!-- name -->
            <div class="mt-4">
                <x-form.input name="name" :value="$user->name" class="border border-dark" type="text" label="الاسم" />
            </div>

            <div class="mt-4">
                <x-form.input name="email" :value="$user->email" class="border border-dark" type="text" label="البريد الالكتروني" />


                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                </div>
                @endif
            </div>

            <div class="mt-4">
                <x-form.input name="image" class="border border-dark" type="file" label="الصورة" />
            </div>


            @if($user->user_type == 'provider')

            <div class="mt-4">
                <label> مقدم الخدمة </label>
                <select class="form-select border border-dark" name="service_id" class=" is-invalid => $errors->has('service_id')">

                    @foreach($services as $service)
                    <option value="{{$service->id}}" @selected($user->service_id == $service->id)> {{$service->name}} </option>
                    @endforeach

                </select>
                @error('provider')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="mt-4">
                <x-form.input name="commercial_register" class="border border-dark" type="text" label="السجل التجاري" :value="$user->commercial_register" />
            </div>

            <div class="mt-4">
                <x-form.input name="services" class="border border-dark" type="text" label=" الخدمة المقدمة " :value="$user->services" />
            </div>

            <div class="mt-4">
                <x-form.input name="address" class="border border-dark" type="text" label=" العنوان " :value="$user->address" />
            </div>

            <div class="mt-4">
                <x-form.input name="experience_year" class="border border-dark" type="number" label=" سنوات الخبرة " :value="$user->experience_year" />
            </div>

            @endif

            <div class="flex items-center gap-4 mt-4">
                <button class="btn text-white form-control" style="background-color:#009FBF;" type="submit"> حفظ </button>

                @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>

    </div>
</section>