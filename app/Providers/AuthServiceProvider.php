<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        $this->registerPolicies();

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('manajer', function (User $user) {
            return $user->role === 'manajer';
        });

        Gate::define('kasir', function (User $user) {
            return $user->role === 'kasir';
        });

        Gate::define('role', function (User $user, ...$roles) {
            return in_array($user->role, $roles);
        });
    }
}
