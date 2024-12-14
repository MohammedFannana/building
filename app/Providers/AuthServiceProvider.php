<?php

namespace App\Providers;

use App\Models\OverflowMaterial;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // dashbraed access Authroization
        Gate::define('dashboard_access', function (User $user) {
            return $user->type === 'admin' || $user->type === 'super_admin';
        });

        // create how work website in dashboard 
        Gate::define('create_how_work', function (User $user) {
            $workCount = Work::count();
            // إذا كان هناك سجل واحد أو أكثر، عدم السماح بالإضافة
            return $workCount < 1;
        });


        // create add free Period
        Gate::define('free_period', function (User $user) {
            return $user->type === 'super_admin';
        });



        Gate::define('edit_overflow_material', function (User $user, OverflowMaterial $overflowMaterial) {
            return $user->id === $overflowMaterial->user_id;
        });
    }
}
