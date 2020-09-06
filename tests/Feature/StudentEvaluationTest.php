<?php

namespace Tests\Feature;

use App\Section;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentEvaluationTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function test_teacher_could_evaluate_student()
    {

        $this->actingAsSanctumUser();

        $section = factory(Section::class)->create();

        $student = factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        $section->assignStudent($student);

        $response =  $this->putJson(route('evaluations.evaluateStudent', ['section' => $section, 'user' => $student]), [
            'speaking' => random_int(0, 10),
            'writing' => random_int(0, 10),
            'conversation' => random_int(0, 10),
            'reading' => random_int(0, 10),
            'vocabulary' => random_int(0, 10),
            'grammar' => random_int(0, 10),
            'notes' => ''
        ]);
            
        $response->assertCreated();

        $response =  $this->putJson(route('evaluations.evaluateStudent', ['section' => $section, 'user' => $student]), [
            'speaking' => random_int(0, 10),
            'writing' => random_int(0, 10),
            'conversation' => random_int(0, 10),
            'reading' => random_int(0, 10),
            'vocabulary' => random_int(0, 10),
            'grammar' => random_int(0, 10),
            'notes' => ''
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'speaking',
                'writing',
                'conversation',
                'reading',
                'vocabulary',
                'grammar',
                'notes'
            ]
        ]);

        $this->assertDatabaseCount('student_evaluations', ZLIB_FILTERED);
    }


    public function test_show_student_evaluation()
    {
        $this->actingAsSanctumUser();

        $section = factory(Section::class)->create();

        $student = factory(User::class)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);

        $section->assignStudent($student);

         $this->putJson(route('evaluations.evaluateStudent', ['section' => $section, 'user' => $student]), [
            'speaking' => random_int(0, 10),
            'writing' => random_int(0, 10),
            'conversation' => random_int(0, 10),
            'reading' => random_int(0, 10),
            'vocabulary' => random_int(0, 10),
            'grammar' => random_int(0, 10),
            'notes' => ''
        ]);

        
        $response =  $this->getJson(route('evaluations.showStudentEvaluation' , ['section'=>$section , 'user'=>$student]));

        $response->assertOk();

    }
}
