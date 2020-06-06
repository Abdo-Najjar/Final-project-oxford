<?php

namespace Tests\Feature;

use App\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $data = [
            'first_name' => 'Abdo',
            'last_name' => 'Najjar',
            'email' => "abdo@abdo.com",
            'address' => "Rafah Elbahra street",
            'dob' => '1999-24-1',
            'phone_number' => '0454654556',
            'level' => 'C',
            'days' => "Monday to Friday",
            'time' => date('H:i:s'),
            'major_of_study' => "asdasdsadda",
            'recognize' => "asdsadsadsadasd",
            'notes' => "sadsadsadsadasd",
            'picture_permission' => 1,
            'national_number' => 4545465456456454654,

        ];

        $numberOfExpected = 1;

        $response = $this->postJson(route('applications.store'), $data);
        
        $response->assertCreated();

        $this->assertCount($numberOfExpected , Application::all());
        
        $this->assertDatabaseHas('applications', $data);
    }
}
