<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFavoritesFeatureFlag extends Migration
{
    public function up()
    {

        $feature = new \AlfredNutileInc\LaravelFeatureFlags\FeatureFlag();
        $feature->key = 'add-favorite';
        $feature->variants = ["users" => ['me@alfrednutile.info']];
        $feature->save();
    }

    public function down()
    {

    }
}
