<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CourseType;
use App\User;
use App\UserInfo;
use Faker\Generator as Faker;

$factory->define(UserInfo::class, function (Faker $faker) {

    $users = User::where('usertype_id' , User::STUDENT_TYPE)->get();
    
    return [
        'user_id' => $faker->randomElement($users),
        'course_type_id' => $faker->randomElement(CourseType::all()),
        'days' => $faker->sentence(5),
        'time' => $faker->time,
        'major_of_study' => $faker->word(),
        'how_knew_oxford' => $faker->sentence(3),
        'notes' => $faker->text(),
        'permission_advertisment' => $faker->boolean(),
        'national_number' =>  strval(random_int(10000, 155555)),
    ];
});
