<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Section;
use App\User;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {


    return [
        'course_id' => factory(Course::class),
        'user_id' => factory(User::class),
        'name' =>  $faker->uuid,
        'start_at' => $faker->date(),
        'end_at' => $faker->date(),
    ];
});
