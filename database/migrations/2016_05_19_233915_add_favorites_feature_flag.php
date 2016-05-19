<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFavoritesFeatureFlag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $feature = new \AlfredNutileInc\LaravelFeatureFlags\FeatureFlag();
        $feature->key = 'add-favorite';
        $feature->variants = ["users" => ['me@alfrednutile.info']];
        $feature->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
