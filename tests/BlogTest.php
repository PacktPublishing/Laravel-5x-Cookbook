<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function should_update_blog()
    {
        $user = \App\User::first();

        $this->be($user);

        //Make the blog
        $blog = factory(\App\Blog::class)->create();

        $this->call('PUT', "/blogs/" . $blog->id, 
            [ 
                "title" => "foo", 
                "intro" => "intro here", 
                "mark_down" => "#bar", 
                "html" => "", 
                "active" => 0
            ]);

        $blog = \App\Blog::find($blog->id);

        $this->assertEquals("foo", $blog->title);
        $this->assertEquals("#bar", $blog->mark_down);
        $this->assertContains("<h1>bar</h1>", $blog->html);
        $this->assertEquals(0, $blog->active);
    }

    /**
     * @test
     */
    public function should_update_to_active()
    {
        $user = \App\User::first();

        $this->be($user);

        $blog = factory(\App\Blog::class)->create();

        $this->call('PUT', "/blogs/" . $blog->id,
            [
                "title" => "foo",
                "intro" => "intro here",
                "mark_down" => "#bar",
                "html" => "",
                "active" => "on"
            ]);

        $blog = \App\Blog::find($blog->id);

        $this->assertEquals(1, $blog->active);
    }

    /**
     * @test
     */
    public function should_set_url()
    {
        $user = \App\User::first();

        $this->be($user);

        $blog = factory(\App\Blog::class)->create();

        $this->call('PUT', "/blogs/" . $blog->id,
            [
                "title" => "foo",
                "intro" => "intro here",
                "mark_down" => "#bar",
                "html" => "",
                "active" => "on"
            ]);

        $blog = \App\Blog::find($blog->id);

        $this->assertEquals(1, $blog->active);
    }

    /**
     * @test
     */
    public function should_create_blog()
    {

    }

    /**
     * @test
     */
    public function should_update_image()
    {

    }
}
