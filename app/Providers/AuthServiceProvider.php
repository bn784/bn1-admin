<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        // Auth gates for: admin
        Gate::define('admin_access', function ($user) {
            return in_array($user->role->title, ['administrator']);
        });
        // Auth gates for: User
        Gate::define('user_access', function ($user) {
            return in_array($user->role->title, ['user']);
        });

        // Auth gates for: management_access
        Gate::define('management_access', function ($user) {
            return in_array(1, [$user->role->management_access]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array(1, [$user->role->role_access]);
        });
        Gate::define('role_create', function ($user) {
            return in_array(1, [$user->role->role_create]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array(1, [$user->role->role_edit]);
        });
        Gate::define('role_view', function ($user) {
            return in_array(1, [$user->role->role_view]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array(1, [$user->role->role_delete]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array(1, [$user->role->user_access]);
        });
        Gate::define('user_create', function ($user) {
            return in_array(1, [$user->role->user_create]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array(1, [$user->role->user_edit]);
        });
        Gate::define('user_view', function ($user) {
            return in_array(1, [$user->role->user_view]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array(1, [$user->role->user_delete]);
        });
    }
}
