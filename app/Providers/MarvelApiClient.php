<?php

namespace App\Providers;

use App\MarvelApi;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class MarvelApiClient extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Interfaces\ComicClientInterface::class, function () {
            $config = [
                'base_uri'          => env('MARVEL_API_BASE_URL'),
                'timeout'           => 0,
                'allow_redirects'   => false,
                'verify'            => false,
                'headers'           => [
                    'Content-Type'  => 'application/json'
                ]
            ];

            $client = new Client($config);
            $key = env('MARVEL_API_KEY');
            $secret = env('MARVEL_API_SECRET');
            $client =  new MarvelApi($key, $secret, $client);
            $client->setApiVersion(env('MARVEL_API_VERSION'));
            return $client;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
