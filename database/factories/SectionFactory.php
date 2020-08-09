<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CourseType;
use App\Section;
use App\User;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {

    $courseTypes = CourseType::all();
    return [
        'course_type_id' => $faker->randomElement($courseTypes),
        'user_id' => factory(User::class),
        'name' =>  $faker->uuid,
        'start_at' => $faker->date(),
        'end_at' => $faker->date(),
    ];
});
