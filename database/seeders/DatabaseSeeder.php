<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(CategoryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(SubCategoryTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TwilioSeeder::class);
    }
}
