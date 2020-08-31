<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CourseType;
use App\MassMedia;
use Faker\Generator as Faker;

$factory->define(MassMedia::class, function (Faker $faker) {
    $courseTypes = CourseType::all();

    $urls = [
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/1a.mp3?alt=media&token=32c6b3e5-1f1c-4bd5-b414-a97b6fc43f72',
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/2a.mp3?alt=media&token=29f7534d-db83-406a-bfb3-bde017e528e9',
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/3a.mp3?alt=media&token=6a16c3e3-c353-45f6-98b1-d2a48917fbb0',
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/4a.mp3?alt=media&token=e05c8570-c96b-4953-adbe-6350da56fcfc',
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/5a.mp3?alt=media&token=ded56eb7-8c9c-4a77-a2e1-b41312cc2b43',
    ];


    return [
        'title' => $faker->word(),
        'description' => $faker->sentence(5),
        'url' => $faker->randomElement($urls),
        'type' => MassMedia::MEDIA_AUDIO_TYPE,
        'course_type_id' => $faker->randomElement($courseTypes),
    ];
});



$factory->state(MassMedia::class, 'viedo', function (Faker $faker) {
   
    $courseTypes = CourseType::all();

    $url = [

        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/1.mp4?alt=media&token=5d496ff2-3df0-42cf-b12d-150d21f1796d',
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/2.mp4?alt=media&token=003fbc62-88ef-4a6f-bb71-7c5e723ae4e6',
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/3.mp4?alt=media&token=7f12a6f5-e5cc-4532-baf2-f93a8beeea7f',
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/4.mp4?alt=media&token=29aeaaec-5854-4c33-a6b2-a2a1fd167b2e',
        'https://firebasestorage.googleapis.com/v0/b/learn-english-8960c.appspot.com/o/5.mp4?alt=media&token=5e9eb717-c4b6-4183-8b46-d0daa4f6b48a'
    ];

    return [
        'title' => $faker->word(),
        'description' => $faker->sentence(5),
        'url' => $faker->randomElement($url),
        'type' => MassMedia::MEDIA_VEDIO_TYPE,
        'course_type_id' => $faker->randomElement($courseTypes),
    ];
});
