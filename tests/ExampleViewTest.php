<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleViewTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    /**
     * @test
     */
    public function example_view()
    {

        $user = factory(App\User::class)->create();

        $this->be($user);

        $this->visit(route('example_view'))->see("Hello")->see("World");

        $this->assertResponseOk();

    }
}
