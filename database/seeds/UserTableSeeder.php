<?php

use Illuminate\Database\Seeder;
// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        factory(\App\User::class)->create(
            [
                'email' => 'me@alfrednutile.info',
                'password' => bcrypt(env('ADMIN_PASSWORD'))
            ]
        );
    }
}
