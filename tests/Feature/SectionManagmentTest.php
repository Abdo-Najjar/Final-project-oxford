<?php

namespace Tests\Feature;

use App\Course;
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
                    'name',
                    'course_id',
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
                'course_id',
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

        $courseId = factory(Course::class)->create()->id;

        $userId = factory(User::class,)->create([
            'usertype_id' => User::TEACHER_TYPE
        ])->id;

        $response = $this->postJson(route('sections.store'), [
            'course_id' => $courseId,
            'user_id' => $userId,
            'start_at' => Carbon::create(2020, 3, 21)->format('Y-m-d'),
            'end_at' => Carbon::create(2020, 3, 30)->format('Y-m-d'),
        ]);


        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'course_id',
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

        $courseId = factory(Course::class)->create()->id;

        $userId = factory(User::class)->create([
            'usertype_id' => User::TEACHER_TYPE
        ])->id;

        $sectionId = factory(Section::class)->create()->id;

        $response = $this->patchJson(route('sections.update', $sectionId), [
            'course_id' => $courseId,
            'user_id' => $userId,
            'start_at' => Carbon::create(2020, 3, 21)->format('Y-m-d'),
            'end_at' => Carbon::create(2020, 3, 30)->format('Y-m-d'),
        ]);

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

        $this->actingAsSanctumUser();

        $section = factory(Section::class)->create();

        $user = factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        $response =  $this->putJson(route('sections.assign', ['section' => $section, 'user' => $user]));

        $response->assertNoContent();

        $numberOfAssignedUsers = 1;

        $this->assertDatabaseCount('section_user', $numberOfAssignedUsers);
    }



    public function test_fire_student_from_class_endpoint()
    {

        $this->actingAsSanctumUser();

        $section = factory(Section::class)->create();

        $user = factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        $this->assertDatabaseCount('section_user', ZLIB_OK);


        //assgin user throw elequant relation
        $section->students()->sync($user->id);

        $response =  $this->deleteJson(route('sections.fire', ['section' => $section, 'user' => $user]));

        $response->assertNoContent();

        $numberOfAssignedUsers = 0;

        $this->assertDatabaseCount('section_user', $numberOfAssignedUsers);
    }
}
