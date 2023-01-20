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
        Gate::define('Seguridad – emancipación', function ($user) {
            if (getTipoUsuario() == 'Seguridad – emancipación'){
                return true;
            }
            return false;
        });
        Gate::define('Seguridad – Salaverry', function ($user) {
            if (getTipoUsuario() == 'Seguridad – Salaverry'){
                return true;
            }
            return false;
        });
        Gate::define('Seguridad – Carabaya', function ($user) {
            if (getTipoUsuario() == 'Seguridad – Carabaya'){
                return true;
            }
            return false;
        });

        Gate::define('Auxiliar - Carabaya', function ($user) {
            if (getTipoUsuario() == 'Auxiliar - Carabaya'){
                return true;
            }
            return false;
        });
        Gate::define('Auxiliar - Emancipación', function ($user) {
            if (getTipoUsuario() == 'Auxiliar - Emancipación'){
                return true;
            }
            return false;
        });
        Gate::define('Auxiliar - Salaverry', function ($user) {
            if (getTipoUsuario() == 'Auxiliar - Salaverry'){
                return true;
            }
            return false;
        });
    }
}
