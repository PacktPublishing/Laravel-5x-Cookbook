<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SlugTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /**
     * @test
     */
    public function see_if_slug_works()
    {
        $user = factory(\App\User::class)->create();

        $this->assertNotNull($user->url);
    }

    /**
     * @test
     */
    public function see_if_slog_null_name()
    {
        $user = \App\User::create(
            [
                'email' => 'foo@foo.com'
            ]
        );

        $this->assertNotNull($user->url);

        $this->assertEquals('foo', $user->name);

        $this->assertEquals('foo', $user->url);
    }

}
