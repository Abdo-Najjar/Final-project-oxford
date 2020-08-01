<?php

use App\Advertisement;
use App\Course;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        // //advertisement images
        // $advertisements = Advertisement::all();

        // $faker = Faker::create();
        // $imageUrl = $faker->imageUrl(640,480, null, false);

        // foreach($advertisements as $advertisement){
        //     $advertisement->addMediaFromUrl($imageUrl)->toMediaCollection('images');
        // }

        // //course images
        // $courses = Course::all();

        // $faker = Faker::create();
        // $imageUrl = $faker->imageUrl(640,480, null, false);

        // foreach($courses as $course){
        //     $course->addMediaFromUrl($imageUrl)->toMediaCollection('images');
        // }

    }
}
