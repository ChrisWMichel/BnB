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
        // $this->call(UserSeeder::class);
       // factory(\App\Models\User::class, 20)->create();
        factory(\App\Models\Bookable::class, 40)->create();
    }
}
