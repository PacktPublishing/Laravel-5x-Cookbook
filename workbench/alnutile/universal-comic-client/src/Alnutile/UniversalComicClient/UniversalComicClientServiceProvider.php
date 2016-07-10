<?php

namespace Alnutile\UniversalComicClient;

use Alnutile\UniversalComicClient\MarvelApi;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class UniversalComicClientServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->app->bind(\Alnutile\UniversalComicClient\ComicClientInterface::class, function () {
			$config = [
				'base_uri'          => Config::get('marvel.MARVEL_API_BASE_URL'),
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
			$client->setApiVersion(Config::get('marvel.MARVEL_API_VERSION'));
			return $client;
		});

		$this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'universal-comic-client');

		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'universal-comic-client');

		$this->publishes([
			__DIR__.'/../../../src/config/marvel.php' => config_path('marvel.php'),
		], 'config');
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

	public function provides()
	{
		return [];
	}

}
