<?php

namespace Tests\Feature;

use App\Section;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SectionEvaluationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_student_could_evaluate_section()
    {

        $this->withExceptionHandling();

        $this->actingAsSanctumUser();

        $section = factory(Section::class)->create();

        $response = $this->putJson(route('evaluations.section', $section), $data = [
            'speaking' => random_int(1, 10),
            'converstion'  => random_int(1, 10),
            'reading'  => random_int(1, 10),
            'writing'  => random_int(1, 10),
            'vocab'  => random_int(1, 10),
            'english_speaking'  => random_int(1, 10),
            'commitment_time' => random_int(1, 10)
        ]);

        $response->assertCreated();
        
        $this->assertDatabaseHas('section_evaluations' , $data);
    }
}
