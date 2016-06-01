<?php

use Illuminate\Database\Seeder;
// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        factory(\App\User::class)->create(
            [
                'email' => 'me@alfrednutile.info',
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'is_admin' => 1
            ]
        );
        
        factory(\App\User::class)->create(
            [
                'email' => 'demo@foo.com',
                'password' => bcrypt(env('DEMO_PASSWORD'))
            ]
        );


        factory(\App\User::class, 10)->create()->each(function($u) {
            factory(\Laravel\Cashier\Subscription::class)->create(
                ['name' => "Level 1", "stripe_id" => \App\Plans::$LEVEL1, "user_id" => $u->id]
            );
        });

        factory(\App\User::class, 2)->create()->each(function($u) {
            factory(\Laravel\Cashier\Subscription::class)->create(
                ['name' => "Fan", 'stripe_id' => \App\Plans::$FAN, 'user_id' => $u->id]
            );
        });

        factory(\App\User::class, 2)->create()->each(function($u) {
            factory(\Laravel\Cashier\Subscription::class)->create(
                    [
                        'name' => "Level 2",
                        'user_id' => $u->id,
                        'stripe_id' => \App\Plans::$LEVEL2,
                        'trial_ends_at' => \Carbon\Carbon::now()->day(rand(4,10))
                    ]
                );
        });

        factory(\App\User::class, 5)->create()->each(function($u) {
                factory(\Laravel\Cashier\Subscription::class)->create(
                    ['name' => "Level 2", 'stripe_id' => \App\Plans::$LEVEL2, 'user_id' => $u->id]
                );
        });
        
    }
}
