<?php

use App\User;
use Illuminate\Database\Seeder;


class WishListTableSeeder extends Seeder {

    public function run()
    {
        $user = User::first();
        
        factory(\App\WishList::class, 20)->create(['user_id' => $user->id]);
    }

}