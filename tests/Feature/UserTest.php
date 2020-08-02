<?php

namespace Tests\Feature;

use App\CourseType;
use App\User;
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

        $this->actingAsSanctumUser();

        $response = $this->postJson(route('users.store'), [
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

        $response->assertJsonStructure([

            'data' => [
                [
                    'id',
                    'first_name',
                    'last_name',
                    'phone_number',
                    'dob'
                ]
            ],
            'meta' => [],
            'links' => []

        ]);
    }
}
