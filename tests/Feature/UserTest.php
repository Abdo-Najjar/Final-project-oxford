<?php

namespace Tests\Feature;

use App\CourseType;
use App\Section;
use App\User;
use App\UserInfo;
use App\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function test_loggin_user_can_store_student()
    {
        $this->withoutExceptionHandling();

        $this->actingAsSanctumUser();

        $response = $this->postJson(route('users.store'), [
            'address' => $this->faker->word(),
            'gender' => 1,
            'first_name' => $this->faker->word,
            'password' => $this->faker->paragraph(),
            'last_name' => $this->faker->word(),
            'email' => $this->faker->email,
            'dob' => $this->faker->date(),
            'phone_number' => '0598414952',
            'days' => $this->faker->word(),
            'time' => date('H:i', strtotime($this->faker->time)),
            'major_of_study' => $this->faker->word(),
            'how_knew_oxford' => $this->faker->sentence(10),
            'notes' => $this->faker->sentence(10),
            'permission_advertisment' => $this->faker->boolean(),
            'national_number' => random_int(1000, 50000),
            'course_type_id' => $this->faker->randomElement(CourseType::all())->id,
            'usertype_id' => '1'
        ]);

        $response->assertCreated();

        $numberOfUsers = 2;

        $this->assertDatabaseCount('users', $numberOfUsers);
    }

    public function test_list_all_teachers()
    {
        $this->actingAsSanctumUser();


        factory(User::class, 20)->create([
            'usertype_id' => User::TEACHER_TYPE
        ]);

        $response =   $this->getJson(route('teachers.index'));

        $response->assertOk();

        $response->assertJsonCount(ZLIB_FULL_FLUSH);

        $response->assertJsonStructure([

            'data' => [
                [
                    'id',
                    'first_name',
                    'last_name',
                    'phone_number',
                    'dob',
                    'address',
                    'gender'
                ]
            ],
            'meta' => [],
            'links' => []

        ]);
    }



    public function test_get_all_students_in_course_type()
    {
        $this->actingAsSanctumUser();

        $student =  factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        factory(UserInfo::class)->create([
            'user_id' => $student->id
        ]);

        // dd(User::find(ZLIB_NEED_DICT)->userInfo);
        $courseTypeId = User::find(ZLIB_NEED_DICT)->userInfo->courseType->id;

        $response =  $this->getJson(route('students.studentsInCourseType', $courseTypeId));

        $response->assertJsonStructure([

            'data' => [
                [
                    'id',
                    'first_name',
                    'last_name',
                    'phone_number',
                    'dob',
                    'address',
                    'gender'
                ]
            ],
            'meta' => [],
            'links' => []

        ]);

        $response->assertJsonCount(ZLIB_FULL_FLUSH);
    }



    public function test_get_all_students_in_section()
    {
        $this->actingAsSanctumUser();

        $section = factory(Section::class)->create();

        $students = factory(User::class, 20)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        $students->each(function ($student) use ($section) {

            $section->assignStudent($student);
        });


        $response =  $this->getJson(route('students.studentsInSection', $section->id));

        $response->assertJsonStructure([

            'data' => [
                [
                    'id',
                    'first_name',
                    'last_name',
                    'phone_number',
                    'dob',
                    'address',
                    'gender'
                ]
            ],
            'meta' => [],
            'links' => []
        ]);
    }

    public function test_get_all_section_for_teacher()
    {

        $this->actingAsSanctumUser();

        User::first()->sections()->create([
            'course_type_id' => CourseType::first()->id,
            'start_at' => $this->faker->date(),
            'end_at' => $this->faker->date(),
        ]);


        $response =  $this->getJson(route('teachers.sections'));

        $response->assertOk();
    }
}
