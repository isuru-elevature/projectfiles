<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ActionstepOAuth;

class ActionstepServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ActionstepOAuth::class, function ($app) {
            $clientId = config('services.actionstep.client_id');
            $clientSecret = config('services.actionstep.client_secret');
            $authUrl = config('services.actionstep.auth_url');
            $tokenUrl = config('services.actionstep.token_url');
            $redirectUrl = config('services.actionstep.redirect_url');

            return new ActionstepOAuth($clientId, $clientSecret, $authUrl, $tokenUrl, $redirectUrl);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
