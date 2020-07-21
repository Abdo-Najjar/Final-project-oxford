<?php

namespace Tests\Feature;

use App\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseManagementTest extends TestCase
{

  use RefreshDatabase;

  //view all courses
  public function test_loggin_user_could_see_courses()
  {

    //acting as login user from token based auth      
    $this->actingAsSanctumUser();

    //before fetching courses first insert into database some courses
    factory(Course::class, 50)->create();

    //send request to fetch courses
    $response = $this->getJson(route('courses.index'));

    //assert response that has correct body
    $response->assertJsonStructure([
      'data' => [
        [
          'id',
          'type',
          'image',
          'description',
          'details',
          'price',
          'books_fees',
          'min_age',
          'level',
          'mook_exam',
          'duration',
          'class_size',
          'weeks',
          'days',
          'hours',
          'start',
          'time'
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
    $courseId = factory(Course::class)->create()->id;

    //make request to get a course
    $response = $this->getJson(route('courses.show', ['course' => $courseId]));

    //assert response that has correct body
    $response->assertJsonStructure([

      'data' => [
        'id',
        'type',
        'image',
        'description',
        'details',
        'price',
        'books_fees',
        'min_age',
        'level',
        'mook_exam',
        'duration',
        'class_size',
        'weeks',
        'days',
        'hours',
        'start',
        'time'
      ]
    ]);
  }


  public function test_logged_in_user_can_store_course()
  {
    
    

  }

}
