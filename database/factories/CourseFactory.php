<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'type' => $faker->word(),
        'description' => $faker->paragraph(),
        'details' => $faker->paragraph(),
        'price' => random_int(100, 500),
        'books_fees' => random_int(100, 500),
        'min_age' => random_int(100, 500),
        'level' => $faker->word(),
        'mook_exam' => random_int(0, 5),
        'duration' => $faker->word(),
        'class_size' => random_int(0, 5),
        'weeks' => random_int(0, 5),
        'days' => $faker->sentence(5),
        'hours' => random_int(1, 3),
        'start' => $faker->sentence(5),
        'time' => $faker->time,
    ];
});
