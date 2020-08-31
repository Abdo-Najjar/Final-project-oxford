<?php

use App\CourseType;
use App\User;
use App\UserType;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class)->create([
            'email' => 'admin@admin.com',
            'usertype_id' => UserType::whereType('admin')->first()->id
        ]);

        $teacher = factory(User::class)->create([
            'email' => 'teacher@teacher.com',
            'usertype_id' => UserType::whereType('teacher')->first()->id
        ]);

            for ($i=0; $i <4 ; $i++) { 
                $teacher->sections()->create([
                    'course_type_id' => CourseType::first()->id,
                    'start_at' => now(),
                    'end_at' => now(),
                    ]);
                    
                }


        factory(User::class)->create([
            'email' => 'student@student.com',
            'usertype_id' => UserType::whereType('student')->first()->id
        ]);


        factory(User::class, 10)->create([
            'usertype_id' => User::STUDENT_TYPE
        ]);
    }
}
