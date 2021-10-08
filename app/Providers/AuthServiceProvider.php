<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(
            'view-admin-panel',
            fn (User $user) => $user->role === $user::ROLE_MANAGER
        );

        Gate::define('save-feedback', function (User $user): bool {
            return $user->feedback()
                ->where(
                    'created_at',
                    '>=',
                    Carbon::now()->subDay()->toDateTimeString()
                )->doesntExist();
        });
    }
}
