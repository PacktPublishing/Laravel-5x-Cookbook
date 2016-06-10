<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\File;

class SeeIfItemIsSeriesAndGetSeriesIdTest extends TestCase
{
    
    use \App\SeriesTrait;
    /**
     * @test
     */
    public function should_see_this_is_a_series()
    {
        $seeder = File::get(base_path('tests/fixtures/star_wars_seeder.json'));

        $comic_object = json_decode($seeder, true)[0];

        $this->assertNotFalse($this->isSeries($comic_object));

        $this->assertEquals("19242", $this->isSeries($comic_object));
    }

    /**
     * @test
     */
    public function should_not_be_a_series()
    {
        $seeder = File::get(base_path('tests/fixtures/star_wars_seeder.json'));

        $comic_object = json_decode($seeder, true)[0];

        unset($comic_object['series']);

        $this->assertFalse($this->isSeries($comic_object));

    }

    /**
     * @test
     */
    public function should_see_if_series_future_date()
    {
        $seeder = File::get(base_path('tests/fixtures/series_stories_with_future_date.json'));

        $series_object = json_decode($seeder, true)['data']['results'];
        
        $this->assertCount(2, $this->setMaxDate(\Carbon\Carbon::parse('2016-06-01T00:00:00-0400'))
            ->hasFutureSeriesDate($series_object));

    }

    /**
     * @test
     */
    public function should_see_if_series_does_not_have_future_date()
    {
        $seeder = File::get(base_path('tests/fixtures/series_stories_with_future_date.json'));

        $series_object = json_decode($seeder, true)['data']['results'];

        $this->assertCount(0, $this->setMaxDate(\Carbon\Carbon::parse('2018-06-01T00:00:00-0400'))->hasFutureSeriesDate($series_object));

    }
}
