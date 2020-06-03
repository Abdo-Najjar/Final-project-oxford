<?php

namespace Tests\Feature;

use App\Advertisement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{

    use RefreshDatabase;

    public function test_gest_can_get_advertisement_pagination_data()
    {

        //make some advertisements objects
        factory(Advertisement::class, 10)->create();

        //make request
        $response = $this->getJson(route('advertisements.index'));


        //assert response that has correct body
        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'image',
                    'course_id'
                ]
            ],
            'links' => [],
            'meta' => []
        ]);
    }


    public function test_gest_can_get_advertisement_details()
    {

        $courseId =  factory(Advertisement::class)->create()->course_id;


        $response = $this->getJson(route('advertisements.show' , ['course'=>$courseId]));

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
}
