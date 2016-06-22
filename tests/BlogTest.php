<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\File;

class BlogTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations, WithoutMiddleware;

    /**
     * @test
     */
    public function should_update_blog()
    {

        //Make the blog
        $blog = factory(\App\Blog::class)->create();

        $this->call('PUT', "/blogs/" . $blog->id, 
            [ 
                "title" => "foo bar",
                "intro" => "intro here", 
                "mark_down" => "#bar", 
                "html" => "", 
                "active" => 0
            ]);

        $blog = \App\Blog::find($blog->id);

        $this->assertEquals("foo bar", $blog->title);
        $this->assertEquals("#bar", $blog->mark_down);
        $this->assertContains("<h1>bar</h1>", $blog->html);
        $this->assertEquals(0, $blog->active);
        $this->assertEquals("foo-bar", $blog->url);
    }

    /**
     * @test
     */
    public function should_update_to_active()
    {
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
        $this->markTestSkipped("Hmm did this in Behat should be able to in phpunit");

        $blog = factory(\App\Blog::class)->create();

        $this->visit('/blogs/' . $blog->id . '/edit')
            ->type("foo", "title")
            ->type("intro here", "intro")
            ->type("#bar", "mark_down")
            ->attach(base_path('/tests/fixtures/file_upload_blog.jpg'), "image")
            ->check("active")->press("submit");

        $blog = \App\Blog::find($blog->id);

        $this->assertEquals("foo", $blog->title);
        $this->assertEquals("#bar", $blog->mark_down);
        $this->assertContains("<h1>bar</h1>", $blog->html);
        $this->assertEquals(1, $blog->active);
        $this->assertEquals("file_upload_blog.jpg", $blog->image);
    }

    public function tearDown()
    {
        if(File::exists(base_path('tests/fixtures/file_upload_blog.jpg')))
            File::delete(base_path('tests/fixtures/file_upload_blog.jpg'));

        parent::tearDown();
    }
}
