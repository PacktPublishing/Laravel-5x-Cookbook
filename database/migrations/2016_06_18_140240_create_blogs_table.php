<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blogs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('mark_down');
            $table->text('html');	
            $table->boolean('active')->default(0);
            $table->string('url');
			$table->text('intro')->nullable();
			$table->string('image')->nullable();
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blogs');
	}

}
