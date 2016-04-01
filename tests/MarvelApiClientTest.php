<?php

use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;

class MarvelApiClientTest extends TestCase
{
    /**
     * @test
     */
    public function test_first_setup()
    {
        //1 I need to set Guzzle to pass my key and secret with each request to Marvel
        //2 I then need a method (getAllComicsPaginated) and see if I can connect
        //3 Then I need to move this into a Provider
        //4 Finally I need to make a Service around these interactions with Marvel

        $client = App::make(\App\Interfaces\ComicClientInterface::class);

        $results = $client->comics();

        $this->assertEquals(200, $results['code']);

    }
}
