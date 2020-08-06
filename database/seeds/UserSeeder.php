<?php

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

        factory(User::class)->create([
            'email' => 'teacher@teacher.com',
            'usertype_id' => UserType::whereType('teacher')->first()->id
        ]);


        factory(User::class)->create([
            'email' => 'student@student.com',
            'usertype_id' => UserType::whereType('student')->first()->id
        ]);


        factory(User::class, 10)->create([
            'usertype_id'=>User::STUDENT_TYPE
        ]);
    }
}
