<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableAddUrl extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('url')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumns('users', ['url'])) {
                $table->dropColumn('url');
            }
        });
    }
}
