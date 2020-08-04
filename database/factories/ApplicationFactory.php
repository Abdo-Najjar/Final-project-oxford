<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Application;
use App\CourseType;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Application::class, function (Faker $faker) {
    $courseTypes =  CourseType::all();
    return [
        'first_name' => $faker->word(),
        'gender'=>random_int(1,2),
        'last_name' => $faker->word(),
        'email' => $faker->safeEmail,
        'address' => $faker->word(),
        'dob' => $faker->date(),
        'phone_number' => "059".random_int(0000000,9999999),
        'course_type_id' => $faker->randomElement($courseTypes) ,
        'days' => $faker->word(),
        'time' =>  Carbon::make($faker->time)->format('H:i') ,
        'major_of_study' => $faker->word(),
        'recognize' => $faker->sentence(50),
        'notes' => $faker->sentence(50),
        'picture_permission' => $faker->boolean(),
        'national_number' => $faker->creditCardNumber(),
    ];
});
