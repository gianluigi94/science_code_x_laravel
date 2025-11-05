<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        if (app()->environment() !== 'testing') {

            Gate::define('abilita', function ($user, $abilitaSku) {
                foreach ($user->ruoli as $ruolo) {
                    if ($ruolo->abilita()->where('sku', $abilitaSku)->exists()) {
                        return true;
                    }
                }
                return false;
            });

            Gate::define('ruolo', function ($user, $ruoloRichiesto) {
                foreach ($user->ruoli as $ruolo) {
                    if ($ruolo->ruolo === $ruoloRichiesto) {
                        return true;
                    }
                }
                return false;
            });
        }
    }
}
