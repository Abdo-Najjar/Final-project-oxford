<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionManagmentTest extends TestCase
{

    use WithFaker;
    use RefreshDatabase;

    public function test_admin_could_store_section()
    {
        $this->withoutExceptionHandling();

        $this->actingAsSanctumUser();

        $this->postJson(route('sections.store') , [
                // 'course_id'=> , 
                // 'user_id'=> , 
        ]);


    }
}
