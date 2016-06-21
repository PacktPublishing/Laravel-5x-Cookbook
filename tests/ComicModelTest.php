<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\File;

class ComicModelTest extends TestCase
{
    /**
     * @test
     */
    public function description_should_be_cleaned_out()
    {
        $comic = File::get(base_path('tests/fixtures/mail_comic.json'));
        $comic = json_decode($comic, true);

        $comic = (new \App\ComicModel())->setComic($comic);

        $this->assertNotNull($comic->getDescriptionSafe());

        $this->assertNotEquals($comic->description, $comic->getDescriptionSafe());
    }
}
