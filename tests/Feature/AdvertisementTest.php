<?php

namespace Tests\Feature;

use App\Advertisement;
use App\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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


        $this->withoutExceptionHandling();

        $response = $this->getJson(route('advertisements.show', ['course' => $courseId]));


        $response->assertOk();

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


    public function test_store_advertismenet()
    {

        $this->actingAsSanctumUser();

        $courseId = factory(Course::class)->create()->id;

        $response = $this->postJson(route('advertisements.store'), [

            'image' => UploadedFile::fake()->image('photo.jpg'),

            'course_id' => $courseId
        ]);

        $response->assertCreated();
    }

    public function test_delete_advertismenet()
    {

        $this->actingAsSanctumUser();

        $advertisementId = factory(Advertisement::class)->create()->id;

        $response =   $this->deleteJson(route('advertisements.destroy', $advertisementId));

        $response->assertNoContent();

        $this->assertCount(ZLIB_OK, Advertisement::all());
    }
}
