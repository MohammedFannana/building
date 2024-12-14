<section>
    <div class="row">
        <div class="col-md-5">

            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('تحديث كلمة المرور ') }}
                </h2>

            </header>

            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <div>
                    <x-form.input name="current_password" class="border border-dark" type="password" label='كلمة المرور الحالية' autocomplete="current-password" />
                </div>

                <div class="mt-4">
                    <x-form.input name="password" class="border border-dark" type="password" label='كلمة المرور الجديدة' autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-form.input name="password_confirmation" class="border border-dark" type="password" label='تأكيد كلمة المرور ' autocomplete="new-password" />
                </div>

                <div class="flex items-center gap-4 mt-4">
                    <button class="btn text-white form-control" style="background-color:#009FBF;" type="submit"> حفظ </button>

                    @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>