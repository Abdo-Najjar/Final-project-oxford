<?php

namespace Tests\Feature;

use App\CourseType;
use App\Section;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionManagmentTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;


    public function test_admin_could_see_sections()
    {
        $this->withoutExceptionHandling();

        $this->actingAsSanctumUser();

        factory(Section::class, 20)->create();

        $response = $this->getJson(route('sections.index'));

        $response->assertJsonStructure([

            'data' => [
                [
                    'id',
                    'type',
                    'name',
                    'course_type_id',
                    'user_id',
                    'end_at',
                    'start_at'
                ]
            ],
            'links' => [],
            'meta' => []
        ]);

        $response->assertOk();
    }


    public function test_show_section()
    {
        $this->withoutExceptionHandling();

        $this->actingAsSanctumUser();

        $sectionId = factory(Section::class)->create()->id;

        $response  = $this->getJson(route('sections.show', $sectionId));

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'type',
                'course_type_id',
                'user_id',
                'end_at',
                'start_at'
            ]
        ]);

        $response->assertOk();
    }



    public function test_admin_could_store_section()
    {

        $this->actingAsSanctumUser();


        $userId = factory(User::class,)->create([
            'usertype_id' => User::TEACHER_TYPE
        ])->id;

        $response = $this->postJson(route('sections.store'), [
            'course_type_id' => $this->faker->randomElement(CourseType::all())->id,
            'user_id' => $userId,
            'start_at' => Carbon::create(2020, 3, 21)->format('Y-m-d'),
            'end_at' => Carbon::create(2020, 3, 30)->format('Y-m-d'),
        ]);


        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'course_type_id',
                'user_id',
                'start_at',
                'end_at'
            ]
        ]);

        $response->assertCreated();
    }


    public function test_admin_could_update_section()
    {

        $this->actingAsSanctumUser();


        $userId = factory(User::class)->create([
            'usertype_id' => User::TEACHER_TYPE
        ])->id;

        $sectionId = factory(Section::class)->create()->id;

        $response = $this->patchJson(route('sections.update', $sectionId), [
            'course_type_id' => $this->faker->randomElement(CourseType::all())->id,
            'user_id' => $userId,
            'start_at' => Carbon::create(2020, 3, 21)->format('Y-m-d'),
            'end_at' => Carbon::create(2020, 3, 30)->format('Y-m-d'),
        ])->dump();

        $response->assertNoContent();
    }



    public function test_admin_could_delete_section()
    {

        $this->actingAsSanctumUser();

        $sectionId = factory(Section::class)->create()->id;

        $response =  $this->deleteJson(route('sections.destroy', $sectionId));

        $response->assertNoContent();

        $this->assertDatabaseMissing('sections', ['id' => $sectionId]);
    }



    public function test_assign_student__to_class_endpoint()
    {
        //login as admin
        $this->actingAsSanctumUser();

        //create new section using factory
        $section = factory(Section::class)->create();

        //create new student with type student
        $user = factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        //send put request for assign student to section end point
        $response =  $this->putJson(route('sections.assign', ['section' => $section, 'user' => $user]));
        
        //assert the http response body is empty
        $response->assertNoContent();
        
        //assert section_user table had at lest 1 record (Assgin)
        $this->assertDatabaseCount('section_user', ZLIB_FILTERED);
    }



    public function test_fire_student_from_class_endpoint()
    {

        //login as admin
        $this->actingAsSanctumUser();

        //create new section using factory
        $section = factory(Section::class)->create();

        //create new student with type student
        $user = factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);
        
        //check none of sudents assgin to any class
        $this->assertDatabaseCount('section_user', ZLIB_OK);

        //assgin user throw elequant relation
        $section->students()->sync($user->id);

        //send delete request for fire student from section 
        $response =  $this->deleteJson(route('sections.fire', ['section' => $section, 'user' => $user]));

        //assert that the http body of the response dosenot has any content 
        $response->assertNoContent();

        //assert that the none of th users assgin to sec
        $this->assertDatabaseCount('section_user',ZLIB_NO_FLUSH);
    }
}
