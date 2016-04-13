<?php

use Illuminate\Support\Facades\File;
use Mockery as m;

class SearchControllerTest extends TestCase
{
    public function test_search_comics_no_name()
    {
        //Arrange
        $mock = m::mock('App\Interfaces\ComicClientInterface');
        $fixture = File::get(base_path('tests/fixtures/search_no_name.json'));
        $mock->shouldReceive('comics')->andReturn(json_decode($fixture, true));
        $mock->shouldReceive('getStatusCode')->andReturn(200);
        $mock->shouldReceive('getContent')->andReturn($fixture);
        $this->app->instance('App\Interfaces\ComicClientInterface', $mock);

        //Act
        $results = $this->call('GET', '/api/v1/search');

        //Assert
        $this->assertEquals(200, $results->getStatusCode());
        $content = json_decode($results->getContent(), true);
        $this->assertEquals(20, $content['data']['count']);
    }

    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }
}
