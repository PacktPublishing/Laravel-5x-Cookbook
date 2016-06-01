<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchComicsApiTest extends TestCase
{
    /**
     * @test
     */
    public function api_results_from_search_verify_format()
    {
        $this->markTestSkipped("So I am not hitting the API");

        $results = $this->call('GET', '/api/v1/search?name=Wolverine');

        $this->assertResponseOk();

        $results = $results->getData(true);

        $this->assertArrayHasKey('data', $results);

        $this->assertArrayHasKey('limit', $results['data']);

        $this->assertNotNull($results['data']['results']);

    }
}
