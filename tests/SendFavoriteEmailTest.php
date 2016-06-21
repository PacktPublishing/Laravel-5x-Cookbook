<?php

use App\ComicModel;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\App;

class SendFavoriteEmailTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;
    /**
     * @test
     */
    public function should_handle_latest_favorite()
    {
        //create a latest
        $latest = factory(\App\LatestFavorite::class)->create();
        //The event handler modifies the comic for all listerners

        $handler = new \App\Jobs\SendFavoritesEmail($latest);

        $mock = Mockery::mock('Illuminate\Contracts\Mail\Mailer');

        $mock->shouldReceive('send')->once();

        $handler->handle($mock);

        $this->assertNotNull($handler->getFavorite()->user);
        
        $this->assertNotNull($handler->getComic()->url);

        $this->assertNotNull($handler->getComic()->title);

        $this->assertNotNull($handler->getComic()->getDescriptionSafe());

    }
}
