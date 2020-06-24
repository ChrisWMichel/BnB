<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\Models\User::class, 30)->create();
        //factory(\App\Models\Bookable::class, 50)->create();
        //$this->call(BookingsTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
    }
}
