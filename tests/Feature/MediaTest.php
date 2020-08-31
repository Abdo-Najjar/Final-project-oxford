<?php

namespace Tests\Feature;

use App\MassMedia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MediaTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function test_media_pagination()
    {
        $this->actingAsSanctumUser();

        factory(MassMedia::class, ZLIB_BLOCK)->create();

        $response = $this->getJson(route('media.index'))->dump();

        $response->assertOk();

        $response->assertJsonCount(ZLIB_FULL_FLUSH);
    }


    public function test_media_related_with_courseType_pagination()
    {
        // login as authontcated user
        $this->actingAsSanctumUser();

        //create media with factory
        factory(MassMedia::class, ZLIB_BLOCK)->create([
            'course_type_id'=> ZLIB_FILTERED
        ]);
        //send get request for media/{courseType}/courseType end point
        $response = $this->getJson(route('media.courseTypeIndex' ,ZLIB_FILTERED));

        //assert the status code return is 200
        $response->assertOk();

        //assert the json response has 3 attributes (data , meta and links for pagination)
        $response->assertJsonCount(ZLIB_FULL_FLUSH);
    }



    public function test_media_show()
    {
        $this->actingAsSanctumUser();

        $massMedia =  factory(MassMedia::class)->create();

        $response = $this->getJson(route('media.show', ['massMedia' => $massMedia]));

        $response->assertOk();

        $response->assertJsonCount(ZLIB_STREAM_END);
    }
}
