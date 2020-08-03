<?php

namespace Tests\Unit;

use App\Section;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SectionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_assign_Student_to_section()
    {

        $this->actingAsSanctumUser();

        $section =  factory(Section::class)->create();

        $user = factory(User::class)->create([
            'usertype_id'=>User::STUDENT_TYPE
        ]);

        $section->assignStudent($user);

        $numberOfStudentsAssigned = 1;

        $this->assertDatabaseCount('section_user' ,$numberOfStudentsAssigned );
    }




    

    public function test_fire_Student_to_section()
    {

        $this->actingAsSanctumUser();

        $section =  factory(Section::class)->create();

        $user = factory(User::class)->create([
            'usertype_id'=>User::STUDENT_TYPE
        ]);

        $section->students()->sync($user->id);


        $section->fireStudent($user);

        $numberOfStudentsAssigned = 0;

        $this->assertDatabaseCount('section_user' ,$numberOfStudentsAssigned );

    }

}
