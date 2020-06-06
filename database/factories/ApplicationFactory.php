<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Application;
use Faker\Generator as Faker;

$factory->define(Application::class, function (Faker $faker) {
    return [
        'first_name' => $faker->word(),
        'last_name' => $faker->word(),
        'email' => $faker->safeEmail,
        'address' => $faker->word(),
        'dob' => $faker->date(),
        'phone_number' => $faker->phoneNumber,
        'level' => $faker->word(),
        'days' => $faker->word(),
        'time' => $faker->time,
        'major_of_study' => $faker->word(),
        'recognize' => $faker->sentence(50),
        'notes' => $faker->sentence(50),
        'picture_permission' => $faker->boolean(),
        'national_number' => $faker->creditCardNumber(),
    ];
});
