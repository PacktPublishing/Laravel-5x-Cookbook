<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(WishListTableSeeder::class);
        $this->call(FavoritesSeeder::class);
        $this->call(BlogTableSeeder::class);
    }
}
