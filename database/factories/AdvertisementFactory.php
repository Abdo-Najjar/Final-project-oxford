<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Advertisement;
use App\Course;
use Faker\Generator as Faker;

$factory->define(Advertisement::class, function (Faker $faker) {

    // $images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg'];
    return [
        // 'image' => $images[array_rand($images)],
        'course_id' => factory(Course::class),
    ];
});
