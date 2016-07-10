<?php

use Alnutile\UniversalComicClient\MarvelApi;
use Illuminate\Support\Facades\App;

class MarvelApiClientTest extends TestCase
{
    /**
     * @test
     * @vcr stub_comics_request
     */
    public function test_first_setup()
    {
        $config = [
            'base_uri'          => env('MARVEL_API_BASE_URL'),
            'timeout'           => 0,
            'allow_redirects'   => false,
            'verify'            => false,
            'headers'           => [
                'Content-Type'  => 'application/json'
            ]
        ];

        $guzzle = new \GuzzleHttp\Client($config);
        $key = env('MARVEL_API_KEY');
        $secret = env('MARVEL_API_SECRET');
        $client =  new MarvelApi($key, $secret, $guzzle);
        $client->setApiVersion(env('MARVEL_API_VERSION'));

        $ts = '1459629709';

        $results = $client->setTimeStamp($ts)->comics();

        $this->assertEquals(200, $results['code']);
    }

}
