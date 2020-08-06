<?php

namespace Tests\Feature;

use App\Section;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class FeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_payamnet_to_user_in_section()
    {

        $this->actingAsSanctumUser();

        //create new section
        $section = factory(Section::class)->create();

        //create student
        $student = factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        //assign student inside course
        $section->assignStudent($student);

        $response =  $this->put(route('fee.addFee', ['user' => $student->id, 'section' => $section->id]), [

            'book_fees' => ZLIB_ENCODING_GZIP,
            'course_fees' => ZLIB_ENCODING_DEFLATE

        ])->dump();

        $response->assertNoContent();


        $this->assertDatabaseHas('section_user', [
            'course_fees' => ZLIB_ENCODING_GZIP,
            'course_fees' => ZLIB_ENCODING_DEFLATE
        ]);
    }



    public function test_add_payamnet_to_user_not_in_section()
    {

        $this->actingAsSanctumUser();

        //create new section
        $section = factory(Section::class)->create();

        //create student
        $student = factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        $response =  $this->put(route('fee.addFee', ['user' => $student->id, 'section' => $section->id]), [

            'book_fees' => ZLIB_ENCODING_GZIP,
            'course_fees' => ZLIB_ENCODING_DEFLATE

        ]);

        $response->assertStatus(Response::HTTP_EXPECTATION_FAILED);


        $this->assertDatabaseMissing('section_user', [
            'course_fees' => ZLIB_ENCODING_GZIP,
            'course_fees' => ZLIB_ENCODING_DEFLATE
        ]);
    }
}
