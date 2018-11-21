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
         $this->call(UsersTableSeeder::class);
         $this->call(LoveTableSeeder::class);
         $this->call(SystemTableSeeder::class);
         $this->call(TypeTableSeeder::class);
    }
}
