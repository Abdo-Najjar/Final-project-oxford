<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Section;
use App\User;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'course_id' => factory(Course::class),
        'teacher_id' => factory(User::class),
        'code' => $faker->word(),
    ];
});
