<?php

namespace Tests\Feature;

use App\Application;
use App\Section;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
   use RefreshDatabase;
   use WithFaker;

    public function test_ensure_home_page_for_admin_dashboard()
    {
        $this->actingAsSanctumUser();


        factory(User::class , ZLIB_FULL_FLUSH)->create([
            'usertype_id'=>User::STUDENT_TYPE
        ]);
        
        $teachers = factory(User::class , ZLIB_FULL_FLUSH)->create([
            'usertype_id'=>User::TEACHER_TYPE
        ]);

        factory(Section::class , ZLIB_FULL_FLUSH)->create([
            'user_id'=> $this->faker->randomElement($teachers)
        ]);

        factory(Application::class , ZLIB_FULL_FLUSH);

        $response =  $this->getJson(route('dashboard.home'));

        $response->assertOk();

        $response->assertJson([
            'data'=>[
                'students'=>ZLIB_FULL_FLUSH,
                'teachers'=>ZLIB_FULL_FLUSH,
                'sections'=>ZLIB_FULL_FLUSH,
                'applications'=>ZLIB_FULL_FLUSH
            ]
        ]);
    }
}
