<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionManagmentTest extends TestCase
{

    use RefreshDatabase;

    public function test_admin_could_create_section()
    {
        $this->actingAsSanctumUser();


    }
}
