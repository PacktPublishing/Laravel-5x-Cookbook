<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleFactoryTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * @test
     */
    public function should_have_twitter_name()
    {
        $user = factory(\App\User::class)->create(['twitter' => 'foo']);

        $this->assertEquals('foo', $user->twitter);
    }
}
