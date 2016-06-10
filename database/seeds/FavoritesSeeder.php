<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FavoritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Setup a comic that is part of a series
         * then I will use this to get the series
         * and notify the user of new ones
         */
        $user_id = \App\User::where('email', 'me@alfrednutile.info')->first()->id;

        $seeder = File::get(base_path('tests/fixtures/star_wars_seeder.json'));

        $seeder = json_decode($seeder, true)[0];

        factory(\App\Favorite::class)->create(
            [
                'user_id' => $user_id,
                'comic'  => $seeder
            ]
        );
    }
}
