<?php

namespace Tests\Feature;

use App\Application;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ApplicaitonTest extends TestCase
{

    use RefreshDatabase;

    public function test_get_all_application_with_pagination_for_a_login_user()
    {

        $this->actingAsSanctumUser();

        factory(Application::class, 10)->create();

        $response = $this->getJson(route('applications.index'));

        $response->assertJsonStructure([
            'data' => [
                [
                    'first_name',
                    'last_name',
                    'gender',
                    'email',
                    'address',
                    'dob',
                    'phone_number',
                    'level',
                    'days',
                    'time',
                    'major_of_study',
                    'recognize',
                    'notes',
                    'picture_permission',
                    'national_number',

                ]
            ],
            'links' => [],
            'meta' => []
        ]);

        $response->assertOk();
    }



    public function test_guest_user_could_send_an_application()
    {

        $this->withoutExceptionHandling();

        $data = [
            'first_name' => 'abdo',
            'last_name' => 'Najjar',
            'email' => 'abdo@abdo.com',
            'gender' =>'2',
            'address' => 'Rafah Elbahra street',
            'dob' => Carbon::create(2018, 2, 1)->format('Y-m-d'),
            'phone_number' => '0454654556',
            'level' => 'C',
            'days' => 'Monday to Friday',
            'time' => date('H:i'),
            'major_of_study' => 'asdasdsadda',
            'recognize' => 'asdsadsadsadasd',
            'notes' => 'sadsadsadsadasd',
            'picture_permission' => "1",
            'national_number' => "4545465456456454654",

        ];



        $numberOfExpected = 1;


        $response = $this->postJson(route('applications.store'), $data)->dump();


        $response->assertCreated();

        $this->assertCount($numberOfExpected, Application::all());

        $this->assertDatabaseHas('applications', $data);
    }

    public function test_validattion_require_store_method()
    {


        $data = [
            'first_name' => '',
            'gender'=>'',
            'last_name' => '',
            'email' => '',
            'address' => '',
            'dob' => '',
            'phone_number' => '',
            'level' => '',
            'days' => '',
            'time' => '',
            'major_of_study' => '',
            'recognize' => '',
            'notes' => '',
            'picture_permission' => '',
            'national_number' => '',

        ];

        $response = $this->postJson(route('applications.store'), $data);


        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.first_name', [$this->require_message('first name')])
            ->assertJsonPath('errors.last_name', [$this->require_message('last name')])
            ->assertJsonPath('errors.email', [$this->require_message('email')])
            ->assertJsonPath('errors.gender', [$this->require_message('gender')])
            ->assertJsonPath('errors.address', [$this->require_message('address')])
            ->assertJsonPath('errors.dob', [$this->require_message('date of birth')])
            ->assertJsonPath('errors.phone_number', [$this->require_message('phone number')])
            ->assertJsonPath('errors.level', [$this->require_message('level')])
            ->assertJsonPath('errors.days', [$this->require_message('days')])
            ->assertJsonPath('errors.time', [$this->require_message('time')])
            ->assertJsonPath('errors.major_of_study', [$this->require_message('major of study')])
            ->assertJsonPath('errors.picture_permission', [$this->require_message('picture permission')])
            ->assertJsonPath('errors.national_number', [$this->require_message('national number')]);
    }

}
