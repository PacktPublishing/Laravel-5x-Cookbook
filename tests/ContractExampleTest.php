<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContractExampleTest extends TestCase
{
    /**
     * @test
     */
    public function expected_keys_and_values_for_getting_all_comics()
    {
        /** @var \App\MarvelApi::class $client */
        $client = App::make(\App\Interfaces\ComicClientInterface::class);

        $expected = $client->comics()['data'];

        $this->assertArrayHasKey('results', $expected);
        $this->assertArrayHasKey('id', $expected['results'][0]); //maybe choose a random point
        $this->assertArrayHasKey('title', $expected['results'][0]);
        $this->assertArrayHasKey('description', $expected['results'][0]);
        $this->assertInternalType('integer', $expected['results'][0]['issueNumber']);
    }
}
