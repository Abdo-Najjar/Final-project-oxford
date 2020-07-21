<?php

use App\CourseType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    
        $courseTypes = [
            [
                'name'=>'IELT',
            ],
            [
                'name'=>'A1'
            ],
            [
                'name'=>'A2'
            ],
            [
               'name'=> 'B1'
            ],
            [
                'name'=>'B1+'
            ],
            [
                'name'=>'B2'
            ],
            [
                'name'=>'C1'
            ],
            [
                'name'=>'Speaking'
            ],
            [
                'name'=>'Academic Writing'
            ],
            [
                'name'=>'Business'
            ],
            [
                'name'=>'ESP'
            ]
        ];
        

        foreach($courseTypes as $courseType){

            CourseType::create($courseType);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_types');
    }
}
