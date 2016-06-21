<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\User::saving(function ($user) {
            if ( ! $user->name) {
                $user->name = substr($user->email, 0, strrpos($user->email, '@'));
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laralib\L5scaffold\GeneratorsServiceProvider');
        }
    }
}
