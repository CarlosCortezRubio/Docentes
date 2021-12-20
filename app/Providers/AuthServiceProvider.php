<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('Administrador', function ($user) {
            if (getTipoUsuario() == 'Administrador'){
                return true;
            }
            return false;
        });
        Gate::define('Jurado', function ($user) {
            if (getTipoUsuario() == 'Jurado'){
                return true;
            }
            return false;
        });
    }
}
