<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class IsAdminTest extends TestCase
{
    use DatabaseMigrations;

    use DatabaseTransactions;

    /**
     * @test
     */
    public function user_should_be_rejected()
    {
        $user = factory(\App\User::class)->create();

        $this->be($user);

        $this->call('GET', '/admin/users');

        $this->assertResponseStatus(301);

        $this->visit('/admin/users')->see("You need to be admin to see this page.");
    }

    /**
     * @test
     */
    public function user_should_not_be_rejected()
    {
        $user = factory(\App\User::class)->create(
            ['is_admin' => 1]
        );

        $this->be($user);

        $this->call('GET', '/admin/users');

        $this->assertResponseStatus(200);

        $this->visit('/admin/users')->see("You are here");
    }
}
