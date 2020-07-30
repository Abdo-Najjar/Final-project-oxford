<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->longText('details');
            $table->double('price');
            $table->double('books_fees');
            $table->integer('min_age');
            $table->integer('mook_exam');
            $table->string('duration');
            $table->integer('class_size');
            $table->integer('weeks');
            $table->string('days');
            $table->integer('hours');
            $table->string('start');
            $table->time('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
