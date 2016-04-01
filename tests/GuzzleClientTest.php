<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;

class GuzzleClientTest extends TestCase
{
    /**
     * @test
     */
    public function should_query_wikipedia()
    {
        $service = App::make(\App\Interfaces\ClientInterface::class);

        $response = $service->request('GET', 'wiki/Main_Page');
        
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function seeing_our_facade_work()
    {
        $response = \App\Facades\APIClient::request('GET', 'wiki/Main_Page');

        $this->assertEquals(200, $response->getStatusCode());
    }

}
