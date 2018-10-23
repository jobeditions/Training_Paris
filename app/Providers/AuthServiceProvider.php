<?php
/**
 * Copyright (c) Liigem 2016.
 */

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

        Gate::define('accessAdminPanel', function ($user)
        {
            return $user->rank == 'admin';
        });
        Gate::define('accessTeacherPanel', function ($user)
        {
            return $user->rank == 'user';
        });
    }
}
