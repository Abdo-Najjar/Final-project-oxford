<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\UserInfo;
use App\UserType;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    $types = UserType::all();

    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'dob' => $faker->date(),
        'gender'=>random_int(1,2),
        'address'=>$faker->city,
        'email_verified_at' => now(),
        'usertype_id' => $faker->randomElement($types),
        'phone_number'=>"059".random_int(0000000,9999999),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
