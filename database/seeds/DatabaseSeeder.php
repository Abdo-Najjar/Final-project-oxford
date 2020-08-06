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
        $this->call(UserSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(UserInfoSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(AdvertisementSeeder::class);
        $this->call(ApplicationSeeder::class);
        $this->call(MediaSeeder::class);
    }
}
