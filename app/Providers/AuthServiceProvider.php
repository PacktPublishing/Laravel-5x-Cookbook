<?php

namespace App\Providers;

use App\Profile;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

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
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('see-profile', function ($user, $profile) {
                try
                {
                    return $user->id === $profile->user_id;
                }
                catch (\Exception $e)
                {
                    Log::info(sprintf("Error seeing profile %s for user %s message %s", $profile->id, $user->id, $e->getMessage()));
                }
            }
        );
    }
}
