<?php

use App\Advertisement;
use App\Course;
use Illuminate\Database\Seeder;
class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // // advertisement images
        // $advertisements = Advertisement::all();

        // foreach ($advertisements as $advertisement) {
        //     $advertisement->addMediaFromUrl(env('APP_URL') . '/advertisements/' . strval(random_int(1, 4)) . '.jpg')->toMediaCollection('images');
        // }

        // //course images
        // $courses = Course::all();

        // foreach ($courses as $course) {
        //     $course->addMediaFromUrl(env('APP_URL') . '/advertisements/' . strval(random_int(1, 4)) . '.jpg')->toMediaCollection('images');
        // }
    }
}
