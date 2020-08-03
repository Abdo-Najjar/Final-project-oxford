<?php

namespace Tests\Feature;

use App\Course;
use App\CourseType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CourseManagementTest extends TestCase
{
  use WithFaker;
  use RefreshDatabase;

  //view all courses
  public function test_loggin_user_could_see_courses()
  {

    //acting as login user from token based auth      
    $this->actingAsSanctumUser();

    //before fetching courses first insert into database some courses
    factory(Course::class, 20)->create();

    // $imageUrl =  $this->faker->imageUrl(640, 480, null, false);

    $courses = Course::all();

    // foreach ($courses as $course) {
    //   $course->addMediaFromUrl($imageUrl)->toMediaCollection('images');
    // }
    //send request to fetch courses
    $response = $this->getJson(route('courses.index'));

    //assert response that has correct body
    $response->assertJsonStructure([
      'data' => [
        [
          'id',
          'title',
          'type',
          'image',
          'description',
          'details',
          'price',
          'books_fees',
          'min_age',
          'mook_exam',
          'duration',
          'class_size',
          'weeks',
          'days',
          'hours',
          'start',
          'time',
        ]
      ],
      'links' => [],
      'meta' => []
    ]);
  }


  //test to show course
  public function test_logged_in_user_can_show_course()
  {

    //loggin via token based
    $this->actingAsSanctumUser();

    //create course and get id from the returned object
    $course = factory(Course::class)->create();

    // $imageUrl =  $this->faker->imageUrl(640, 480, null, false);

    // $course->addMediaFromUrl($imageUrl)->toMediaCollection('images');

    $courseId = $course->id;

    //make request to get a course
    $response = $this->getJson(route('courses.show', ['course' => $courseId]));

    //assert response that has correct body
    $response->assertJsonStructure([

      'data' => [
        'id',
        'title',
        'type',
        'image',
        'description',
        'details',
        'price',
        'books_fees',
        'min_age',
        'mook_exam',
        'duration',
        'class_size',
        'weeks',
        'days',
        'hours',
        'start',
        'time',
      ]
    ]);
  }


  public function test_logged_in_user_can_store_course()
  {
    $this->actingAsSanctumUser();

    $courseTypes = CourseType::all();

    $response =  $this->postJson(route('courses.store'), [

      'title' => $this->faker->word(),

      'course_type_id' => $this->faker->randomElement($courseTypes)->id,

      'image' => UploadedFile::fake()->image('photo.jpg'),

      'description' => $this->faker->sentence(10),

      'details' => $this->faker->sentence(10),

      'price' => random_int(1, 6),

      'books_fees' => random_int(1, 6),

      'min_age' => random_int(1, 6),

      'mook_exam' => random_int(1, 6),

      'duration' => $this->faker->word(),

      'class_size' => random_int(1, 6),

      'weeks' => random_int(1, 6),

      'days' => $this->faker->dayOfWeek,

      'hours' => random_int(1, 6),

      'start' => $this->faker->word(),

      'time' => date('H:i', strtotime($this->faker->time)),

    ]);



    $response->assertCreated();

    $this->assertDatabaseCount('courses', 1);
  }


  public function test_user_could_update_course()
  {

    $this->actingAsSanctumUser();

    $course = factory(Course::class)->create();

    //fake image for course
    // $imageUrl =  $this->faker->imageUrl(640, 480, null, false);
    //assgin image for course
    // $course->addMediaFromUrl($imageUrl)->toMediaCollection('images');

    $courseId = $course->id;

    $courseTypes = CourseType::all();

    $response = $this->patchJson(route('courses.update', $courseId), [

      'title' => $this->faker->word(),

      'course_type_id' => $this->faker->randomElement($courseTypes)->id,

      'image' => UploadedFile::fake()->image('photo.jpg'),

      'description' => $this->faker->sentence(10),

      'details' => $this->faker->sentence(10),

      'price' => random_int(1, 6),

      'books_fees' => random_int(1, 6),

      'min_age' => random_int(1, 6),

      'mook_exam' => random_int(1, 6),

      'duration' => $this->faker->word(),

      'class_size' => random_int(1, 6),

      'weeks' => random_int(1, 6),

      'days' => $this->faker->dayOfWeek,

      'hours' => random_int(1, 6),

      'start' => $this->faker->word(),

      'time' => date('H:i', strtotime($this->faker->time)),

    ]);

    $response->assertNoContent();
  }


  public function test_logged_in_user_can_delete_course()
  {

    $this->actingAsSanctumUser();

    $courseId = factory(Course::class)->create();

    $response =  $this->deleteJson(route('courses.destroy', $courseId));

    $response->assertNoContent();
    
    $this->assertDatabaseCount('courses' , ZLIB_OK);
  }
}
