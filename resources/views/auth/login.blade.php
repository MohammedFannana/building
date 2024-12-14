<x-main-layout title="عَمَاركم">

    <div class="register_login row">
        <div class="col-md-5 m-auto">

            <!-- Session Status -->

            <a class="btn btn-light border border-0 button">الدخول</a>
            <a class="btn button" style="background-color:transparent;" href="{{route('register')}}">التسجيل</a>

            <x-auth-session-status class="mb-4" :status="session('status')" />


            <form method="POST" action="{{ route('login') }}" class="rounded">
                @csrf



                <!-- Phone -->
                <div>
                    <x-form.input name="phone" for="phone" class="border border-dark" type="text" label="رقم الجوال" autocomplete="none" autofocus />
                </div>


                <!-- Password -->
                <div class="mt-4">
                    <x-form.input name="password" for="password" class="border border-dark" type="password" label="كلمة المرور" autocomplete="new-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('تذكرني') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">

                    <button class="btn text-white form-control mb-3" style="background-color:#009FBF;" type="submit">سجل الان </button>

                    @if (Route::has('password.request'))
                    <a class="text-decoration-none text-sm text-danger dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('هل نسيت كلمة المرور ؟') }}
                    </a>
                    @endif

                </div>
            </form>
        </div>
    </div>

</x-main-layout>